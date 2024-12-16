<?php

namespace App\Http\Requests\Date;

use App\Http\Requests\BaseFormRequest;

class DateRequest extends BaseFormRequest
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
            'dates' => 'required|array',
            'dates.*' => 'required|date|date_format:Y-m-d|exists:dates,date',
            'semester' => 'integer|exists:semesters,number',
        ];
    }
}
