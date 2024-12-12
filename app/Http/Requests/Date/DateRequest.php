<?php

namespace App\Http\Requests\DateRequests;

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
            'day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday',
            'group' => 'required|string|exists:groups,name',
            'dates' => 'sometimes|array',
            'dates.*' => 'date|date_format:Y-m-d|exists:dates,date',
        ];
    }
}
