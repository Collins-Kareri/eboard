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
     * @param string $email the email of the invited user
     * @param string $role the role of the invited user
     * @param string $department the department the invited user will be a part of
     * @param string $route the route that will be in the signed url generated for the invitee. If a department creation we use onboard.create else register.create
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
