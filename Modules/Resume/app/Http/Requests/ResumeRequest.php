<?php

namespace Modules\Resume\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Resume\Models\Resume;

class ResumeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'birthday' => ['required','regex:/^[1-4]\d{3}\/((0[1-6]\/((3[0-1])|([1-2][0-9])|(0[1-9])))|((1[0-2]|(0[7-9]))\/(30|([1-2][0-9])|(0[1-9]))))$/'],
            'gender' => ['required', Rule::in(Resume::$genders)],
            'military' => 'required_if:gender,male|string|max:100',
            'skill' => 'required|string|max:100',
            'wageDemand' => 'nullable|string|max:250',
            'martial' => ['required',Rule::in(Resume::$martials)],
            'status' => ['required',Rule::in(Resume::$status)],
            'shahrestan.*' => 'nullable|numeric|exists:shahrestan,id',
            'jobType.*' => ['required',Rule::in(Resume::$jobTypes)],
            'aboutMe' => ['nullable','string','min:2','max:1550'],
            'career_name.*' => ['nullable','string','min:2','max:75'],
            'career_title.*' => ['nullable','string','min:2','max:75'],
            'career_time.*' => ['nullable','string','min:2','max:55'],
            'career_job.*' => ['nullable','numeric','digits:1'],
            'career_des.*' => ['nullable','string','min:2','max:1550'],
            'edu_degree.*' => ['nullable','string','min:2','max:75'],
            'edu_name.*' => ['nullable','string','min:2','max:75'],
            'edu_field.*' => ['nullable','string','min:2','max:75'],
            'edu_time.*' => ['nullable','string','min:2','max:75'],
            'edu_point.*' => ['nullable','string','min:2','max:75'],
            'edu_continue.*' => ['nullable','numeric','digits:1'],
            'edu_des.*' => ['nullable','string','min:2','max:1550'],
            'project_name.*' => ['nullable','string','min:2','max:75'],
            'project_address.*' => ['nullable','string','min:2','max:75'],
            'project_time.*' => ['nullable','string','min:2','max:55'],
            'project_skills.*' => ['nullable','string','min:2','max:250'],
            'project_des.*' => ['nullable','string','min:2','max:1550'],
            'course_name.*' => ['nullable','string','min:2','max:75'],
            'course_link.*' => ['nullable','string','min:2','max:260'],
            'course_time.*' => ['nullable','string','min:2','max:150'],
            'skill_name.*' => ['nullable','string','min:2','max:50'],
            'skill_level.*' => ['nullable','string','min:2','max:50'],
            'lang_name.*' => ['nullable','string','min:2','max:50'],
            'lang_level.*' => ['nullable','string','min:2','max:50'],
            'social_name.*' => ['nullable','string','min:2','max:35'],
            'social_value.*' => ['nullable','string','min:2','max:290'],
            'category_id.*' => 'nullable|numeric|exists:categories,id',
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
