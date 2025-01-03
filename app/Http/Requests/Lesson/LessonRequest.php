<?php

namespace App\Http\Requests\Lesson;

use App\Http\Requests\BaseFormRequest;

class LessonRequest extends BaseFormRequest
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
            'has_weekly_schedule' => 'required|boolean',
            'date' => 'nullable|required_if:has_weekly_schedule,false|date|exists:dates,date',
            'semester' => 'integer|exists:semesters,id',
        ];
    }

    public function messages(): array
    {
        return [
            'date' => [
                'required_if' => 'Поле :attribute обязательно для заполнения, когда :other ложно(0)',
            ]
        ];
    }
}
