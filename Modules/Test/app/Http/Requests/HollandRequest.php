<?php

namespace Modules\Test\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HollandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mobile' => ['nullable', 'numeric', 'regex:/(0|\+98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/'],
            'check1.*' => ['nullable','numeric','digits_between:1,2'],
            'check2.*' => ['nullable','numeric','digits_between:1,2'],
            'check3.*' => ['nullable','numeric','digits_between:1,2'],
            'check4.*' => ['nullable','numeric','digits_between:1,2'],
            'check5.*' => ['nullable','numeric','digits_between:1,2'],
            'check6.*' => ['nullable','numeric','digits_between:1,2'],
            'check7.*' => ['nullable','numeric','digits_between:1,2'],
            'check8.*' => ['nullable','numeric','digits_between:1,2'],
            'check9.*' => ['nullable','numeric','digits_between:1,2'],
            'check10.*' => ['nullable','numeric','digits_between:1,2'],
            'check11.*' => ['nullable','numeric','digits_between:1,2'],
            'check12.*' => ['nullable','numeric','digits_between:1,2'],
            'check13.*' => ['nullable','numeric','digits_between:1,2'],
            'check14.*' => ['nullable','numeric','digits_between:1,2'],
            'check15.*' => ['nullable','numeric','digits_between:1,2'],
            'check16.*' => ['nullable','numeric','digits_between:1,2'],
            'check17.*' => ['nullable','numeric','digits_between:1,2'],
            'check18.*' => ['nullable','numeric','digits_between:1,2'],
            'check19' => ['required','numeric','digits:1'],
            'check20' => ['required','numeric','digits:1'],
            'check21' => ['required','numeric','digits:1'],
            'check22' => ['required','numeric','digits:1'],
            'check23' => ['required','numeric','digits:1'],
            'check24' => ['required','numeric','digits:1'],
            'check25' => ['required','numeric','digits:1'],
            'check26' => ['required','numeric','digits:1'],
            'check27' => ['required','numeric','digits:1'],
            'check28' => ['required','numeric','digits:1'],
            'check29' => ['required','numeric','digits:1'],
            'check30' => ['required','numeric','digits:1'],
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
