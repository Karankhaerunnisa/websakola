<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            // harus '0'/'1' karena kolom di db bertipe string
            'is_registration_open' => $this->has('is_registration_open') ? '1' : '0'
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'school_name' => ['required', 'string', 'max:100'],
            'school_address' => ['required', 'string'],
            'school_phone' => ['required', 'string'],
            'school_email' => ['required', 'email'],

            'academic_year' => ['required', 'string'],
            'registration_start_date' => ['required', 'date'],
            'registration_end_date' => ['required', 'date', 'after:registration_start_date'],
            'is_registration_open' => ['boolean'],

            // Logo validation (Optional, max 2MB)
            'app_logo' => ['nullable', 'image', 'max:2048'],
            'document_header' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
