<?php

namespace Modules\Visit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Visit\Models\Visit;

class VisitUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:190',
            'status' => ['nullable', Rule::in(Visit::$statuses)],
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:visits,slug,'. request()->id,
            'university_id' => 'nullable|numeric|exists:universities,id',
            'expert' => ['nullable','string','min:2'],
            'video' => 'nullable|required_without:videoLink|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/x-flv,video/webm|max:2048000',
            'videoLink' => 'nullable|required_without:video|string',
            'des' => ['nullable','string','min:2'],
            'tags' => 'nullable|string',
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
