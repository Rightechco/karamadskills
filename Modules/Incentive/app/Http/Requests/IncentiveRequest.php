<?php

namespace Modules\Incentive\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncentiveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name.*' => ['required','string','min:2','max:225'],
            'time.*' => ['required','numeric','min:1','max:2000'],
            'location.*' => ['required','string','min:2','max:225'],
            'type.*' => ['required','numeric','min:1','max:6'],
            'unit.*' => ['nullable','numeric','min:1','max:1000'],
            'file.*' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:4048',
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
