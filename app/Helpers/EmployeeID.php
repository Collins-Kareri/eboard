<?php

namespace App\Helpers;

use App\Enums\UserRole;
use App\Models\User;

class EmployeeID
{
    /**
     * Generate employee id of the form EB-x, where x is based on the count of users in the users table.
     */
    public static function generate()
    {
        $start=User::whereNot('role', UserRole::Contractor->value)->count();
        return "EB-".($start+1);
    }

    public static function idGenerate(int $start)
    {
        return "EB-".($start+1);
    }

    /**
     * Generate Id of a contract user
     */
    public static function contractorId()
    {
        $start=User::where('role', UserRole::Contractor->value)->count();
        return "EB-C-".($start+1);
    }
}
