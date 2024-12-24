<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Models\Role;

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
            'login' => 'required|unique:users,login|string|min:4|max:50',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer|exists:roles,id',
            'group_id' => [
                'required_if:role_id,' . Role::role('student') . ',' . Role::role('teacher'),
                'integer',
                'exists:groups,id'
            ],
        ];
    }

    public function messages(): array
    {
        $roleNames = [
            'admin' => 'админ',
            'student' => 'студент',
            'teacher' => 'преподаватель'
        ];

        return [
            'group_id' => [
                'required_if' => 'Поле :attribute обязательна для заполнения, когда :other' . ' ' . $roleNames[Role::roleName($this->request->get('role_id'))],
            ]
        ];
    }
}
