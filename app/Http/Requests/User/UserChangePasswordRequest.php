<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:7', 'different:old_password'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'new_password' => Hash::make($this->new_password)
        ]);
    }
}
