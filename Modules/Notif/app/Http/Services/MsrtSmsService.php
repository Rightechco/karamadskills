<?php

namespace Modules\Notif\Http\Services;

use Exception;
use Illuminate\Support\Facades\Http;
include 'nusoap.php';
use nosoap_client;
use SoapClient;
use SoapFault;

// Import Str for UUID generation

class MsrtSmsService
{
    protected string $userid;
    protected string $password;
    protected string $apiUrl;
    protected string $originator;

    /**
     * Constructor to initialize the service with configuration values.
     */
    public function __construct()
    {
        $this->userid = config('notif.kar_userid');
        $this->password = config('notif.kar_password');
        $this->apiUrl = config('notif.kar_api_url');
        $this->originator = config('notif.kar_originator');
    }

    /**
     * Sends a simple SMS using SOAP.
     *
     * @param string $mobile The recipient's mobile number.
     * @param string $message The message content.
     * @return array An associative array containing status and message.
     */
    public function sendSMS(string $mobile, string $message): array
    {
        try {
            $client = $this->initializeSoapClient();
            $doerid = $this->generateDoerId(); // Generate dynamic doerid
            $requestData = $this->buildXmlRequest('smssend', $this->buildSmsBody($mobile, $message, $doerid));

            return $this->makeSoapCall($client, 'XmsRequest', $requestData);
        } catch (Exception $e) {
            return $this->formatErrorResponse($e->getMessage());
        }
    }

    /**
     * Initializes the SOAP client.
     *
     * @return SoapClient The initialized SOAP client.
     * @throws Exception If an error occurs during initialization.
     */
    protected function initializeSoapClient(): SoapClient
    {
        try {
            return new SoapClient($this->apiUrl, ['encoding' => 'UTF-8', 'trace' => true, 'exceptions' => true]);
        } catch (Exception $e) {
            throw new Exception("SOAP Client Initialization Error: " . $e->getMessage());
        }
    }

    /**
     * Generates a dynamic doerid.
     *
     * @return string The generated doerid (timestamp).
     */
    protected function generateDoerId(): string
    {
        return time();
    }

    /**
     * Builds the XML request body.
     *
     * @param string $action The action to be performed.
     * @param string $body The body of the request.
     * @return string The complete XML request.
     */
    protected function buildXmlRequest(string $action, string $body): string
    {
        return <<<XML
            <xmsrequest>
                <userid>{$this->userid}</userid>
                <password>{$this->password}</password>
                <action>{$action}</action>
                <body>{$body}</body>
            </xmsrequest>
        XML;
    }

    /**
     * Builds the body for a single SMS request.
     *
     * @param string $mobile The recipient's mobile number.
     * @param string $message The message content.
     * @param string $doerid The dynamically generated doerid.
     * @return string The constructed SMS body.
     */
    protected function buildSmsBody(string $mobile, string $message, string $doerid): string
    {
        return <<<XML
            <type>oto</type>
            <recipient mobile="{$mobile}" originator="{$this->originator}" doerid="{$doerid}">{$message}</recipient>
        XML;
    }

    /**
     * Makes a SOAP call and handles the response.
     *
     * @param SoapClient $client The SOAP client.
     * @param string $function The SOAP function to call.
     * @param string $requestData The request data to send.
     * @return array An associative array containing status and message.
     */
    protected function makeSoapCall(SoapClient $client, string $function, string $requestData): array
    {
        try {
            $params = ['requestData' => $requestData];
            $result = $client->__soapCall($function, [$params]);

            if (isset($result->XmsRequestResult)) {
                return $this->formatSuccessResponse($result->XmsRequestResult);
            }

            return $this->formatErrorResponse('No valid response received.');
        } catch (SoapFault $fault) {
            return $this->formatErrorResponse('SOAP Fault: ' . $fault->getMessage());
        } catch (Exception $e) {
            return $this->formatErrorResponse('Error: ' . $e->getMessage());
        }
    }

    /**
     * Formats a successful response.
     *
     * @param string $response The response message.
     * @return array An associative array containing status and message.
     */
    protected function formatSuccessResponse(string $response): array
    {
        return [
            'status' => 'success',
            'message' => htmlspecialchars($response, ENT_QUOTES)
        ];
    }

    /**
     * Formats an error response.
     *
     * @param string $errorMessage The error message.
     * @return array An associative array containing status and message.
     */
    protected function formatErrorResponse(string $errorMessage): array
    {
        return [
            'status' => 'error',
            'message' => htmlspecialchars($errorMessage, ENT_QUOTES)
        ];
    }

    /**
     * Sends a batch SMS message using SOAP.
     *
     * @param string $message The message content.
     * @param array $recipients The list of recipient mobile numbers.
     * @return array An associative array containing status and message.
     */
    public function sendBatchSms(string $message, array $recipients): array
    {
        try {
            $client = $this->initializeSoapClient();
            $doerid = $this->generateDoerId(); // Generate dynamic doerid
            $body = $this->buildBatchSmsBody($message, $recipients, $doerid);
            $requestData = $this->buildXmlRequest('smssend', $body);

            return $this->makeSoapCall($client, 'XmsRequest', $requestData);
        } catch (Exception $e) {
            return $this->formatErrorResponse($e->getMessage());
        }
    }

    /**
     * Builds the body for a batch SMS request.
     *
     * @param string $message The message content.
     * @param array $recipients The list of recipient mobile numbers.
     * @param string $doerid The dynamically generated doerid.
     * @return string The constructed batch SMS body.
     */
    protected function buildBatchSmsBody(string $message, array $recipients, string $doerid): string
    {
        $recipientsXml = implode('', array_map(fn($recipient) => "<recipient>{$recipient}</recipient>", $recipients));

        return <<<XML
            <type>otm</type>
            <message originator="{$this->originator}" doerid="{$doerid}">{$message}</message>
            <senddate>
                <allowtime>7-23</allowtime>
            </senddate>
            {$recipientsXml}
        XML;
    }

    /**
     * Sends a request to the SMS API using HTTP.
     *
     * @param string $action The action to be performed.
     * @param string $body The body of the request in XML format.
     * @return array An associative array containing status and message.
     */
    protected function sendRequest(string $action, string $body): array
    {
        $xmlRequest = $this->buildXmlRequest($action, $body);

        try {
            $response = Http::withHeaders(['Content-Type' => 'text/xml'])
                ->post($this->apiUrl, $xmlRequest);

            if ($response->successful()) {
                return $this->formatSuccessResponse($response->body());
            }

            return $this->formatErrorResponse('HTTP Error: ' . $response->status() . ' - Response: ' . $response->body());
        } catch (Exception $e) {
            return $this->formatErrorResponse('HTTP Request Error: ' . $e->getMessage());
        }
    }

    // Additional methods for handling SMS status, credit check, etc.
}
