<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Course\Models\Course;

class CourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|min:2|max:190',
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:courses,slug',
            'category_id' => 'required|array',
            'category_id.*' => 'required|numeric|exists:categories,id',
            'courseable' => 'required',
            'teacher' => 'required|numeric|exists:users,id',
            'price' => 'nullable|numeric',
            'note' => ['nullable','string','min:2','max:550'],
            'cover' => 'required|mimes:jpg,jpeg,png,webp|max:4048',
            'ownerPercent' => 'nullable|numeric',
            'teacherPercent' => 'nullable|numeric',
            'limit' => 'nullable|numeric',
            'expert' => ['nullable','string','min:2'],
            'des' => ['nullable','string','min:2'],
            'tags' => 'nullable|string',
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
