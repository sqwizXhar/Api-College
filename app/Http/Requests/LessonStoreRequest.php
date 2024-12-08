<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonStoreRequest extends FormRequest
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
            'semester' => 'required|string',
            'day_of_week' => 'required|string|max:15',
            'time' => 'required|string|date_format:H:i',
            'number_of_lesson' => 'required|string',
            'cabinet_id' => 'required|integer|exists:cabinets,id',
            'group_id' => 'required|integer|exists:groups,id',
            'subject_user_id' => 'required|integer|exists:subject_user,id',
        ];
    }
}
