<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\UserRole;

class DepartmentInvitePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if member can invite others
     */
    public function sendInvite(User $user)
    {
        return $user->role==UserRole::Manager->value;
    }
}
