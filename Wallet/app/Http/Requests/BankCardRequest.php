<?php

namespace Modules\Wallet\Http\Requests;

use App\Rules\CardNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class BankCardRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'card_number' => ['required', new CardNumberRule,'unique:bank_cards,card_number'],
            'shaba_number' => 'required|digits:24|unique:bank_cards,shaba_number'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
