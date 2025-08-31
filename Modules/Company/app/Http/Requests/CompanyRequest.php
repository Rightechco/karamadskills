<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Company\Models\Company;

class CompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|min:2|max:190',
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$)/u|unique:companies,slug',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:4048',
            'cover' => 'nullable|mimes:jpg,jpeg,png,webp|max:8048',
            'foundation' => 'nullable|string|min:2|max:85',
            'population' => 'nullable|string|min:2|max:85',
            'companyLat' => 'nullable|numeric',
            'companyLang' => 'nullable|numeric',
            'expert' => 'nullable|string|min:2',
            'website' => 'nullable|string|min:2',
            'des' => 'nullable|string|min:2',
            'tags' => 'nullable|string',
            'user' => 'nullable|numeric|exists:users,id'
        ];
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
