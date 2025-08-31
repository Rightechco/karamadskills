<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Course\Models\Course;

class CourseUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:190',
            'status' => ['nullable', Rule::in(Course::$statuses)],
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:courses,slug,'. request()->id,
            'category_id' => 'required|array',
            'category_id.*' => 'required|numeric|exists:categories,id',
            'courseable' => 'required',
            'teacher' => 'required|numeric|exists:users,id',
            'price' => 'nullable|numeric',
            'note' => ['nullable','string','min:2','max:550'],
            'cover' => 'nullable|mimes:jpg,jpeg,png,webp|max:4048',
            'ownerPercent' => 'required|numeric',
            'teacherPercent' => 'required|numeric',
            'limit' => 'nullable|numeric',
            'expert' => ['nullable','string','min:2'],
            'des' => ['nullable','string','min:2'],
            'tags' => 'nullable|string',
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
