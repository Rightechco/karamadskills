<?php

namespace Modules\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:190|unique:roles,name,'.request()->id,
            'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:roles,slug,'.request()->id,
            'permissions' => 'nullable|array|min:1'
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
