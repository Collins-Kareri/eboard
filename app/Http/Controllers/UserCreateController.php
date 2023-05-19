<?php

namespace App\Http\Controllers;

use App\Actions\OnboardUser;
use App\Enums\InviteStatus;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\UserRole;
use App\Http\Requests\RegisterRequest;
use App\Models\DepartmentInvitation;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserCreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @param string $email
     * @param string $role
     */
    public function create(Request $request, string $email='', string $role='')
    {
        $invitation=DepartmentInvitation::where('email', '=', $request->email)->first();

        if(is_null($invitation)||$invitation->status===InviteStatus::Accepted->value) {
            return redirect()->route('login.create');
        }

        if(!$request->hasValidSignature()) {
            abort(404);
        }

        return Inertia::render('Onboard/UserCreate', [
            'email'=>$email
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        Validator::make($request->all(), [
            'email'=>['exists:department_invitations,email']
        ], [
            'email.exists'=>'not found'
        ])->validate();

        $invitation=DepartmentInvitation::where('email', '=', $request->email)->first();

        abort_if($invitation->status===InviteStatus::Accepted->value, 404);

        $user=OnboardUser::makeUser($request, $invitation->role, $invitation->department_name);

        if($invitation->role === UserRole::Contractor->value) {
            $user->contract_start_date=$invitation->contract_start_date;
            $user->contract_end_date=$invitation->contract_end_date;
        }

        $user->markEmailAsVerified();

        $user->save();

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
