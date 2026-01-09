<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMajorRequest extends FormRequest
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
            'code' => ['sometimes', 'required', 'string', 'max:10', Rule::unique('majors', 'code')->ignore($this->route('major'))],
            'name' => ['sometimes', 'required', 'string', 'max:100'],
            'quota' => ['sometimes', 'required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:512'],
            'content' => ['nullable', 'string'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'photo1' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'photo2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
