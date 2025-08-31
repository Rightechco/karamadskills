<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Post\Models\Post;

class PostUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:190',
            'status' => ['nullable', Rule::in(Post::$statuses)],
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:posts,slug,'. request()->id,
            'university_id' => 'nullable|numeric|exists:universities,id',
            'expert' => ['nullable','string','min:2'],
            'des' => ['nullable','string','min:2'],
            'tags' => 'nullable|string',
            'slider' => 'nullable|boolean',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:4048',
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
