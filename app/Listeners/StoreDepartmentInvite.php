<?php

namespace App\Listeners;

use App\Events\DepartmentInviteSent;
use App\Models\DepartmentInvitation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Events\MessageSent;

class StoreDepartmentInvite
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DepartmentInviteSent $event): void
    {
        //
        $event->user->departmentInvitations()->create([
            'email'=>$event->email
        ]);
    }
}
