<?php

namespace Modules\University\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversityEditContentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:4048',
            'stamp' => 'nullable|mimes:png|max:4048',
            'tell' => 'nullable|string|min:3|max:25',
            'website' => 'nullable|string|min:3|max:55',
            'text' => 'nullable|string|min:2',
            'gallery.*' => 'nullable|mimes:jpg,jpeg,png,webp|max:4048'
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
