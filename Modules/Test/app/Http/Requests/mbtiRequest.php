<?php

namespace Modules\Test\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class mbtiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mobile' => ['nullable', 'numeric', 'regex:/(0|\+98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/'],
            'radio1' => 'required|string|max:3',
            'radio2' => 'required|string|max:3',
            'radio3' => 'required|string|max:3',
            'radio4' => 'required|string|max:3',
            'radio5' => 'required|string|max:3',
            'radio6' => 'required|string|max:3',
            'radio7' => 'required|string|max:3',
            'radio8' => 'required|string|max:3',
            'radio9' => 'required|string|max:3',
            'radio10' => 'required|string|max:3',
            'radio11' => 'required|string|max:3',
            'radio12' => 'required|string|max:3',
            'radio13' => 'required|string|max:3',
            'radio14' => 'required|string|max:3',
            'radio15' => 'required|string|max:3',
            'radio16' => 'required|string|max:3',
            'radio17' => 'required|string|max:3',
            'radio18' => 'required|string|max:3',
            'radio19' => 'required|string|max:3',
            'radio20' => 'required|string|max:3',
            'radio21' => 'required|string|max:3',
            'radio22' => 'required|string|max:3',
            'radio23' => 'required|string|max:3',
            'radio24' => 'required|string|max:3',
            'radio25' => 'required|string|max:3',
            'radio26' => 'required|string|max:3',
            'radio27' => 'required|string|max:3',
            'radio28' => 'required|string|max:3',
            'radio29' => 'required|string|max:3',
            'radio30' => 'required|string|max:3',
            'radio31' => 'required|string|max:3',
            'radio32' => 'required|string|max:3',
            'radio33' => 'required|string|max:3',
            'radio34' => 'required|string|max:3',
            'radio35' => 'required|string|max:3',
            'radio36' => 'required|string|max:3',
            'radio37' => 'required|string|max:3',
            'radio38' => 'required|string|max:3',
            'radio39' => 'required|string|max:3',
            'radio40' => 'required|string|max:3',
            'radio41' => 'required|string|max:3',
            'radio42' => 'required|string|max:3',
            'radio43' => 'required|string|max:3',
            'radio44' => 'required|string|max:3',
            'radio45' => 'required|string|max:3',
            'radio46' => 'required|string|max:3',
            'radio47' => 'required|string|max:3',
            'radio48' => 'required|string|max:3',
            'radio49' => 'required|string|max:3',
            'radio50' => 'required|string|max:3',
            'radio51' => 'required|string|max:3',
            'radio52' => 'required|string|max:3',
            'radio53' => 'required|string|max:3',
            'radio54' => 'required|string|max:3',
            'radio55' => 'required|string|max:3',
            'radio56' => 'required|string|max:3',
            'radio57' => 'required|string|max:3',
            'radio58' => 'required|string|max:3',
            'radio59' => 'required|string|max:3',
            'radio60' => 'required|string|max:3',
            'radio61' => 'required|string|max:3',
            'radio62' => 'required|string|max:3',
            'radio63' => 'required|string|max:3',
            'radio64' => 'required|string|max:3',
            'radio65' => 'required|string|max:3',
            'radio66' => 'required|string|max:3',
            'radio67' => 'required|string|max:3',
            'radio68' => 'required|string|max:3',
            'radio69' => 'required|string|max:3',
            'radio70' => 'required|string|max:3',
            'radio71' => 'required|string|max:3',
            'radio72' => 'required|string|max:3',
            'radio73' => 'required|string|max:3',
            'radio74' => 'required|string|max:3',
            'radio75' => 'required|string|max:3',
            'radio76' => 'required|string|max:3',
            'radio77' => 'required|string|max:3',
            'radio78' => 'required|string|max:3',
            'radio79' => 'required|string|max:3',
            'radio80' => 'required|string|max:3',
            'radio81' => 'required|string|max:3',
            'radio82' => 'required|string|max:3',
            'radio83' => 'required|string|max:3',
            'radio84' => 'required|string|max:3',
            'radio85' => 'required|string|max:3',
            'radio86' => 'required|string|max:3',
            'radio87' => 'required|string|max:3'
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
