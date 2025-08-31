<?php

namespace Modules\Test\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class eqRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mobile' => ['nullable', 'numeric', 'regex:/(0|\+98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/'],
            'kh.*' => 'nullable|string|max:4',
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
