<?php

namespace App\Helpers;

use App\Models\User;

class EmployeeId
{
    public static function generate()
    {
        $userCount=User::count();
        return "EB-".($userCount+1);
    }
}
