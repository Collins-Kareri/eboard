<?php

namespace App\Traits;

use App\Events\DepartmentInviteSent;
use App\Mail\DepartmentInvite;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

/**
 * USERS ARE SENT INVITES
 */
trait UserInvite
{
    /**
     * send invite to user
     */
    public function sendInvite(string $email, string $role, string $department, string $route)
    {
        $user=$this;
        $startTime=now();

        $signedUrl=URL::temporarySignedRoute($route, $startTime->addHours(24), [
            'email'=>$email,
            'role'=>$role,
            'department'=>$department
        ]);

        Mail::mailer('smtp')->to($email)->send(
            new DepartmentInvite($signedUrl, $department)
        );

        DepartmentInviteSent::dispatch($email, $user);
    }
}
