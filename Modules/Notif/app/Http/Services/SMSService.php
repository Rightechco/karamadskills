<?php

namespace Modules\Notif\Http\Services;

use Illuminate\Support\Facades\Http;

class SMSService
{
    public static function send($mobile,$text,$code = null)
    {
        if (config('notif.smsDefault') == 'karamad') {
            $msrt = new MsrtSmsService();
            return $msrt->sendSMS($mobile,$text);
        } elseif (config('notif.smsDefault') == 'MeliPayamak') {
            $url = config('notif.meliPayamakUrl');
            $t = json_decode($text,true);
            if(is_array($t)) {
                $text = $t;
            } else {
                $text = [$text];
            }
            if ($code){
                $data = array('bodyId' => intval($code), 'to' => $mobile, 'args' => $text);
            } else {
                $data = array('from' => config('notif.meliPayamakNum'), 'to' => $mobile, 'text' => $text);
            }
            $data_string = json_encode($data);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array('Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        } else {
            try {
                $response = Http::get(config('notif.hamyarUrl')."?method=sendsms&format=json&from=".config('notif.hamyarNum')."&to={$mobile}&text={$text}&type=0&username=".config('notif.hamyarUser')."&password=".config('notif.hamyarPass'));
                return $response;
            } catch (\Throwable $th) {
                return "سرویس اس ام اس دارای اختلال است";
            }
        }
    }
}
