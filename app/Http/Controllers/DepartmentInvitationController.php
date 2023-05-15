<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Events\DepartmentInviteSent;
use App\Mail\DepartmentInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DepartmentInvitationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->user()->cannot('sendInvite', $request->user())) {
            $startTime=now();

            abort(403);
        }

        Validator::make($request->all(), [
            'email'=>['required','email','unique:users'],
            'role'=>['required','string',Rule::in([UserRole::Member->value,UserRole::Contractor->value])]
        ], [
            'email.unique'=>'User already exists'
        ])->validateWithBag('invite');

        Validator::make($request->all(), [
            'email'=>['unique:department_invitations,email']
        ], [
            'email.unique'=>'Invitation already sent, please wait for 24 hours before sending another invitation or invalidate previous one to send  a new one.'
        ])->validateWithBag('invite');

        $startTime=now();

        $signedUrl=URL::temporarySignedRoute('register.create', $startTime->addHours(24), [
            'email'=>$request->input('email'),
            'role'=>$request->input('role')
        ]);
        $department=$request->user()->current_department;

        Mail::mailer('smtp')->to($request->input('email'))->send(
            new DepartmentInvite($signedUrl, $department)
        );

        DepartmentInviteSent::dispatch($request->input('email'), $request->user());

        return back();
    }
}
