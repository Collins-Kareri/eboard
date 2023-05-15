<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use App\Models\Departments;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CreateAdmin
{
    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public static function create(Request $request)
    {
        $request->validate([
            'email'=>['required','email','unique:users'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'job_title'=>['required'],
            'phone_number'=>['required'],
            'password'=>['required',Password::min(8)->mixedCase()->numbers()->symbols()->letterS()]
        ]);

        $department=static::createHrDepartment();

        $user=new User();
        $user->departments()->associate($department);

        $user->fill([
            'email'=>$request->email,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'job_title'=>$request->job_title,
            'phone_number'=>$request->phone_number,
            'password'=>Hash::make($request->password),
            'role'=>UserRole::Manager->value
        ]);

        $user->save();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Create a personal team for the user.
     */
    private static function createHrDepartment(): Departments
    {
        $department=Departments::where('name', 'hr')->first();

        // dd(is_null($department));

        if(!is_null($department)) {
            return $department;
        }

        return Departments::create([
            'name'=>'hr'
        ]);
    }
}
