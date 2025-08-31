<?php

namespace Modules\Test\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RavenRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mobile' => ['nullable', 'numeric', 'regex:/(0|\+98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/'],
            'raven1' => ['nullable','numeric','digits:1'],
            'raven2' => ['nullable','numeric','digits:1'],
            'raven3' => ['nullable','numeric','digits:1'],
            'raven4' => ['nullable','numeric','digits:1'],
            'raven5' => ['nullable','numeric','digits:1'],
            'raven6' => ['nullable','numeric','digits:1'],
            'raven7' => ['nullable','numeric','digits:1'],
            'raven8' => ['nullable','numeric','digits:1'],
            'raven9' => ['nullable','numeric','digits:1'],
            'raven10' => ['nullable','numeric','digits:1'],
            'raven11' => ['nullable','numeric','digits:1'],
            'raven12' => ['nullable','numeric','digits:1'],
            'raven13' => ['nullable','numeric','digits:1'],
            'raven14' => ['nullable','numeric','digits:1'],
            'raven15' => ['nullable','numeric','digits:1'],
            'raven16' => ['nullable','numeric','digits:1'],
            'raven17' => ['nullable','numeric','digits:1'],
            'raven18' => ['nullable','numeric','digits:1'],
            'raven19' => ['nullable','numeric','digits:1'],
            'raven20' => ['nullable','numeric','digits:1'],
            'raven21' => ['nullable','numeric','digits:1'],
            'raven22' => ['nullable','numeric','digits:1'],
            'raven23' => ['nullable','numeric','digits:1'],
            'raven24' => ['nullable','numeric','digits:1'],
            'raven25' => ['nullable','numeric','digits:1'],
            'raven26' => ['nullable','numeric','digits:1'],
            'raven27' => ['nullable','numeric','digits:1'],
            'raven28' => ['nullable','numeric','digits:1'],
            'raven29' => ['nullable','numeric','digits:1'],
            'raven30' => ['nullable','numeric','digits:1'],
            'raven31' => ['nullable','numeric','digits:1'],
            'raven32' => ['nullable','numeric','digits:1'],
            'raven33' => ['nullable','numeric','digits:1'],
            'raven34' => ['nullable','numeric','digits:1'],
            'raven35' => ['nullable','numeric','digits:1'],
            'raven36' => ['nullable','numeric','digits:1'],
            'raven37' => ['nullable','numeric','digits:1'],
            'raven38' => ['nullable','numeric','digits:1'],
            'raven39' => ['nullable','numeric','digits:1'],
            'raven40' => ['nullable','numeric','digits:1'],
            'raven41' => ['nullable','numeric','digits:1'],
            'raven42' => ['nullable','numeric','digits:1'],
            'raven43' => ['nullable','numeric','digits:1'],
            'raven44' => ['nullable','numeric','digits:1'],
            'raven45' => ['nullable','numeric','digits:1'],
            'raven46' => ['nullable','numeric','digits:1'],
            'raven47' => ['nullable','numeric','digits:1'],
            'raven48' => ['nullable','numeric','digits:1'],
            'raven49' => ['nullable','numeric','digits:1'],
            'raven50' => ['nullable','numeric','digits:1'],
            'raven51' => ['nullable','numeric','digits:1'],
            'raven52' => ['nullable','numeric','digits:1'],
            'raven53' => ['nullable','numeric','digits:1'],
            'raven54' => ['nullable','numeric','digits:1'],
            'raven55' => ['nullable','numeric','digits:1'],
            'raven56' => ['nullable','numeric','digits:1'],
            'raven57' => ['nullable','numeric','digits:1'],
            'raven58' => ['nullable','numeric','digits:1'],
            'raven59' => ['nullable','numeric','digits:1'],
            'raven60' => ['nullable','numeric','digits:1'],
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
