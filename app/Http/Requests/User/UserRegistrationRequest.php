<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:13'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:7', 'max:30'],
        ];
    }
}
