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
            'day_of_week' => 'in:true,false',
            'date' => 'required_if:day_of_week,false|date|exists:dates,date',
            'semester' => 'integer|exists:semesters,id',
        ];
    }
}
