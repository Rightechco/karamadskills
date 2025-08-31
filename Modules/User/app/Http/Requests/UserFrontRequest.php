<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFrontRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:35',
            'lastName' => 'required|string|min:2|max:45',
            'mobile' => ['required', 'numeric', 'regex:/(0|\+98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/', 'unique:users,mobile'],
            'skill' => 'required|string',
            'expertise' => 'required|string',
            'ostan' => 'required|numeric|exists:ostan,id',
            'shahrestan' => 'required|numeric|exists:shahrestan,id',
            'bakhsh' => 'required|numeric|exists:bakhsh,id',
            'shahr' => 'nullable|numeric|exists:shahr,id',
            'job' => 'required|string|min:2|max:255',
            'degree' => 'required|string|min:2|max:30',
            'about' => 'required|string|min:2|max:2500',
            'resume' => 'nullable|mimes:pdf|max:2048'
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
