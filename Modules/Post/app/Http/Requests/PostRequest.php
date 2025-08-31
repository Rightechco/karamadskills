<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:190',
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:posts,slug',
            'university_id' => 'nullable|numeric|exists:universities,id',
            'expert' => ['nullable','string','min:2'],
            'des' => ['nullable','string','min:2'],
            'tags' => 'nullable|string',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:4048',
            'slider' => 'nullable|boolean',
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
