<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'exists:users,email'],
            'phone' => ['required', 'exists:users'],
            'password' => ['required', 'string', 'min8'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.exists' => 'Email exists',
            'phone.required' => 'Phone number is required',
            'phone.exists' => 'Phone number exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password should be at least 8 characters',
        ];
    }
}
