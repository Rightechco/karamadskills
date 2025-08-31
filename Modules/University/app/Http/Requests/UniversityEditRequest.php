<?php

namespace Modules\University\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\University\Models\University;

class UniversityEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:190',
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$)/u|unique:universities,slug,'.request()->id,
            'admins.*' => 'nullable|numeric|exists:users,id',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:4048',
            'stamp' => 'nullable|mimes:png|max:4048',
            'state' => ['required',Rule::in(University::$states)],
            'type' => ['required',Rule::in(University::$types)],
            'ostan' => 'required_if:state,vahed|nullable|exists:universities,id',
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
