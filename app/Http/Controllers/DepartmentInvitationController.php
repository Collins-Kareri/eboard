<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Events\DepartmentInviteSent;
use App\Mail\DepartmentInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class DepartmentInvitationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->user()->cannot('addMember', $request->user())) {
            abort(403);
        }

        Validator::make($request->all(), [
            'email'=>['required','email','unique:users'],
            'role'=>['required','string',new Enum(UserRole::class)]
        ])->validateWithBag('addMember');

        $startTime=now();

        $signedUrl=URL::temporarySignedRoute('register', $startTime->addHours(24), [
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
