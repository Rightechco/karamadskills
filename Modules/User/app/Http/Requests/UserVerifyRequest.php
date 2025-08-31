<?php

namespace Modules\User\Http\Requests;

use App\Rules\IranNationalCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class UserVerifyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nationalCode' => ['required','digits:10','unique:users,nationalCode'],
            'nationalCodePic' => 'required|mimes:jpg,jpeg,png,webp|max:4048'
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
