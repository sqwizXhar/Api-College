<?php

namespace App\Http\Requests\GradeRequests;

use App\Http\Requests\BaseFormRequest;

class GradeRequest extends BaseFormRequest
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
            'user' => 'integer|exists:users,id',
            'date' => 'date|date_format:Y-m-d|exists:dates,date',
        ];
    }
}
