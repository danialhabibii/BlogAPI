<?php

namespace App\Action\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordAction
{
    public function execute(User $user, $data)
    {
        if (!Hash::check($data['old_password'], $user->password)) {
            return response()->json(['message' => 'Invalid old password']);
        }

        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);
    }
}
