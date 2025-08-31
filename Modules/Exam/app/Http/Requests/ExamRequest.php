<?php

namespace Modules\Exam\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:190',
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:exams,slug',
            'qname' => 'required|array',
            'qname.*' => 'required|string',
            'qrate' => 'required|array',
            'qrate.*' => 'required|numeric',
            'qcorrect' => 'required|array',
            'qcorrect.*' => 'required|numeric|min:1|max:4',
            'qoption' => 'required|array',
            'qoption.*' => 'required|string',
            'time' => 'required|numeric',
            'pass' => 'required|numeric',
            'certificate' => 'nullable|boolean',
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
