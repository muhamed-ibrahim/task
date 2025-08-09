<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiUpdatePostRequest extends FormRequest
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
            'title'         => 'nullable|string|max:255',
            'description'   => 'nullable|string|min:10',
            'phone_number'  => ['nullable', 'regex:/^(0(10|11|12|15)[0-9]{8}|\+?[1-9][0-9]{1,14})$/'],
        ];
    }
}
