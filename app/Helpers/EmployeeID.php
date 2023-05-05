<?php

namespace App\Helpers;

use App\Models\User;

class EmployeeID
{
    /**
     * Generate employee id of the form EB-x, where x is based on the count of users in the users table.
     */
    public static function generate()
    {
        $start=User::count();
        return "EB-".($start+1);
    }

    public static function factoryGenerate(int $start)
    {
        return "EB-".($start+1);
    }
}
