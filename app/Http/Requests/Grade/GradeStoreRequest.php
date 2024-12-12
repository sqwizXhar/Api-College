<?php

namespace App\Http\Requests\Grade;

use App\Http\Requests\BaseFormRequest;

class GradeStoreRequest extends BaseFormRequest
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
            'grade' => 'required|integer|between:2,5',
            'user_id' => 'required|integer|exists:users,id',
            'date_id' => 'required|date|date_format:Y-m-d|exists:dates,id',
        ];
    }
}
