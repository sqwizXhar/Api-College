<?php

namespace App\Http\Requests\Lesson;

use App\Http\Requests\BaseFormRequest;

class StoreLessonRequest extends BaseFormRequest
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
            'day_of_week' => 'required|string|max:15',
            'time' => 'required|string|date_format:H:i',
            'number_of_lesson' => 'required|string',
            'cabinet_id' => 'required|integer|exists:cabinets,id',
            'subject_user_id' => 'required|integer|exists:subject_user,id',
            'semester_id' => 'required|integer|exists:semesters,id',
        ];
    }
}
