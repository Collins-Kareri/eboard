<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DepartmentInvitationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('sendInvite', User::class);

        Validator::make($request->all(), [
            'email'=>['required','email','unique:users'],
            'role'=>['required','string',Rule::in([UserRole::Member->value,UserRole::Contractor->value])],
            'department_name'=>['required','string','exists:departments,name'],
            'start_time'=>[Rule::requiredIf($request->role===UserRole::Contractor->value),Rule::excludeIf($request->role!==UserRole::Contractor->value),'date'],
            'contract_period'=>[Rule::requiredIf($request->role===UserRole::Contractor->value),Rule::excludeIf($request->role!==UserRole::Contractor->value),'regex:/^\d+\s+(?:day|month|week|year)$/']
        ], [
            'email.unique'=>'User already exists'
        ])->validateWithBag('invite');

        Validator::make($request->all(), [
            'email'=>['unique:department_invitations,email']
        ], [
            'email.unique'=>'Invitation already sent, please wait for 24 hours before sending another invitation or invalidate previous one to send  a new one.'
        ])->validateWithBag('invite');

        $request->user()->sendInvite($request->input('email'), $request->input('role'), $request->input('department_name'), $request->input('start_time'), $request->input('contract_period'));

        return back();
    }
}
