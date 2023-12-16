<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvRequest extends FormRequest
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
            'file' => 'required|mimes:csv|max:10000'
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'You must upload CSV file',
            'file.mimes' => 'You must upload CSV file',
            'file.max' => 'Maximum allowed file size in 10 MB '
        ];
    }
}
