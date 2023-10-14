<?php

namespace App\Action\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserChangePasswordAction
{
    public function execute(User $user, $data)
    {
        if (!Hash::check($data['old_password'], $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['old password incorrect.'],
            ]);
        }

        $user->update([
            'password' => $data['new_password'],
        ]);
    }
}
