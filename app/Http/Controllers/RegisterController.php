<?php

namespace App\Http\Controllers;

use App\Actions\CreateAdmin;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Enums\UserRole;
use App\Models\Departments;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $email='', string $role='')
    {
        if(User::count()<=0) {
            return Inertia::render('Register', [
                'email'=>$email,
                'role'=>UserRole::Manager->value
            ]);
        }

        if(!$request->hasValidSignature()) {
            abort(404);
        }

        return Inertia::render('Register', [
            'email'=>$email,
            'role'=>$role
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

        if(User::count()<=0) {
            return CreateAdmin::create($request);
        }

        $request->validate([
            'email'=>['required','email','unique:users'],
            'role'=>['required','string',new Enum(UserRole::class)],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'job_title'=>['required'],
            'phone_number'=>['required'],
            'password'=>['required',Rules\Password::min(8)->mixedCase()->numbers()->symbols()->letters()],
            'contract_start_date'=>[Rule::requiredIf($request->role===UserRole::Contractor->value)],
            'contract_end_date'=>[Rule::requiredIf($request->role==UserRole::Contractor->value)],
            'department_name'=>['required','string','exists:departments,name']
        ]);

        $department=Departments::where('name', '=', $request->department_name)->first();

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

        if($request->role===UserRole::Contractor->value) {
            $user->contract_start_date=$request->contract_start_date;
            $user->contract_end_date=$request->contract_end_date;
        }

        $user->markEmailAsVerified();

        $user->save();

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
