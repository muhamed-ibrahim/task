<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateUserRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'email' => ['email', Rule::unique('users')->ignore($this->user)],
            'phone_number' => ['nullable', 'regex:/^(0(10|11|12|15)[0-9]{8}|\+?[1-9][0-9]{1,14})$/'],
            'is_admin' => 'nullable|boolean'
        ];
    }
}
