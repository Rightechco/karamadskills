<?php

namespace Modules\Announcement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Announcement\Models\Announcement;
use Modules\Resume\Models\Resume;
use Modules\Test\Models\Test;

class AnnouncementUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'company' => 'required|numeric|exists:companies,id',
            'name' => 'required|string|min:2|max:190',
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:announcements,slug,'. request()->id,
            'ostan' => 'required|numeric|exists:ostan,id',
            'shahrestan' => 'required|numeric|exists:shahrestan,id',
            'wage' => ['nullable','numeric','min:1','max:1000'],
            'background' => ['nullable','string','min:2','max:550'],
            'edu' => ['nullable','string','min:2','max:550'],
            'category_id' => 'required|array',
            'category_id.*' => 'required|numeric|exists:categories,id',
            'announcementLat' => 'nullable|numeric',
            'announcementLang' => 'nullable|numeric',
            'des' => ['nullable','string','min:2'],
            'tags' => 'nullable|string',
            'gender' => ['nullable', Rule::in(Resume::$genders)],
            'status' => ['nullable', Rule::in(Announcement::$statuses)],
            'military' => 'nullable|string|max:100',
            'jobType.*' => ['required',Rule::in(Resume::$jobTypes)],
            'test.*' => ['nullable',Rule::in(Test::$types)],
            'aboutMe' => ['nullable','string','min:2','max:2550'],
            'universityIntership' => 'required|boolean'
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
