<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    public function access(User $user)
    {
        return $user->is_admin === 1;
    }
}
