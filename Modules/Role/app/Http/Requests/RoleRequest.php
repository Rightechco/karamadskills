<?php

namespace Modules\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
          'name' => 'required|string|min:2|max:190|unique:roles,name',
          'slug' => 'nullable|string|min:2|max:190|regex:/(^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$)/u|unique:roles,slug',
          'permissions' => 'nullable|array|min:1'
        ];
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() === true;
    }

    public function attribute()
    {
         return ['permission' => 'دسترسی ها'];
    }
}
