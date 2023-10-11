<?php

namespace App\Action\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserLoginAction
{
    public function execute(array $data): string
    {
        $user = User::firstWhere('email', $data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid password or email']);
        }

        return $user->createToken(request()->header('User-Agent', 'Unknown User Agent'))->plainTextToken;
    }
}
