<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'date' => 'required|date|date_format:Y-m-d',
            'user_id' => 'required|integer|exists:users,id',
            'lesson_id' => 'required|integer|exists:lessons,id'
        ];
    }
}
