<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class StoreUserRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'login' => 'required|unique:users,login|string|min:8|max:50',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer|exists:roles,id',
            'group_id' => 'required_if:role_id,1|required_if:role_id,2|integer|exists:groups,id',
        ];
    }
}
