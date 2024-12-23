<?php

namespace App\Http\Requests\Cabinet;

use App\Http\Requests\BaseFormRequest;

class StoreCabinetRequest extends BaseFormRequest
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
            'purpose' => 'required|string',
            'number' => 'required|string',
        ];
    }
}
