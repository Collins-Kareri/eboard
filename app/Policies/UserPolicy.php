<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class UserPolicy
{
    /**
      * Determine if member can invite others
      */
    public function sendInvite(User $user)
    {
        return $user->role === UserRole::Manager->value;
    }

    /**
     * Determine if a user can retrieve employees
     */
    public function viewEmployees(User $user)
    {
        return $user->role === UserRole::Manager->value;
    }
}
