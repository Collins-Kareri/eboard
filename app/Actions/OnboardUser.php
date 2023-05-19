<?php

namespace App\Actions;

use App\Enums\InviteStatus;
use App\Enums\UserRole;
use App\Models\DepartmentInvitation;
use App\Models\Departments;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class OnboardUser
{
    /**
     * Create user
     * @param Request $request
     * @param string $role
     * @param string $department_name
     */
    public static function makeUser($request, string $role, string $department_name)
    {
        $user=new User();
        $department=null;

        if($role===UserRole::Manager->value) {
            $department=static::makeDepartment($department_name);
        } else {
            $department=static::getDepartment($department_name);
        }

        $user->departments()->associate($department);

        $user->fill([
            'email'=>$request->input('email'),
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'job_title'=>$request->input('job_title'),
            'phone_number'=>$request->input('phone_number'),
            'password'=>Hash::make($request->input('password')),
            'role'=>$role,
            'employeeID'=>''
        ]);

        $user->save();

        DepartmentInvitation::where('email', '=', $request->input('email'))->update([
            'status'=>InviteStatus::Accepted->value
        ]);

        return $user;
    }

    private static function makeDepartment(string $name)
    {
        $department=Departments::create([
            'name'=>$name
        ]);

        return $department;
    }

    private static function getDepartment(string $name)
    {
        return Departments::where('name', '=', $name)->first();
    }
}
