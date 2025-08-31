<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|numeric|exists:categories,id',
            'parent_id' => 'nullable|numeric|exists:categories,id',
            'name' => 'required|string|min:2|max:190|unique:categories,name,'.request()->id,
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:categories,slug,'.request()->id,
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
