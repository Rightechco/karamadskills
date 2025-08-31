<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\User\Models\User;

class UsersTableRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable', Rule::in(User::$statuses)],
            'roles' => 'nullable|exists:roles,id',
            'ostan' => 'nullable|numeric|exists:ostan,id',
            'shahrestan' => 'nullable|numeric|exists:shahrestan,id',
            'bakhsh' => 'nullable|numeric|exists:bakhsh,id',
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
