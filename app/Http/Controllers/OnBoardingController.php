<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Departments;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OnBoardingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $email='', string $role='', string $department='')
    {
        if(!$request->hasValidSignature()) {
            abort(404);
        }

        return Inertia::render('OnBoarding', [
            'email'=>$email,
            'role'=>$role,
            'department'=>$department
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(User::count()>=1) {
            Validator::make($request->all(), [
                'email'=>['exists:department_invitations,email']
            ], [
                'email.exists'=>'not found'
            ])->validate();
        }

        $request->validate([
            'email'=>['required','email','unique:users'],
            'role'=>['required','string',],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'job_title'=>['required'],
            'phone_number'=>['required'],
            'password'=>['required',Rules\Password::min(8)->mixedCase()->numbers()->symbols()->letters()]
        ]);

        $department=Departments::create([
            'name'=>$request->department_name
        ]);

        $user=new User();

        $user->departments()->associate($department);

        $user->fill([
            'email'=>$request->email,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'job_title'=>$request->job_title,
            'phone_number'=>$request->phone_number,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'employeeID'=>''
        ]);

        $user->markEmailAsVerified();

        $user->save();

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);

    }

}
