<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'pic' => 'nullable|mimes:jpg,jpeg,png,webp|max:4048',
            'email' => 'nullable|email|unique:users,email,'.request()->id,
            'uni' => 'nullable|exists:universities,id',
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
