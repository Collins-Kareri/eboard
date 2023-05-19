<?php

namespace App\Listeners;

use App\Enums\InviteStatus;
use App\Enums\UserRole;
use App\Events\DepartmentInviteSent;
use App\Helpers\Calender;
use App\Models\DepartmentInvitation;
use Carbon\Carbon;
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
        $end_date=$event->contractPeriod;

        if($event->role===UserRole::Contractor->value) {
            $end_date=Calender::endDate(Carbon::parse($event->startDate), $event->contractPeriod);
        }

        $event->user->departmentInvitations()->create([
            'email'=>$event->email,
            'role'=>$event->role,
            'department_name'=>$event->department_name,
            'contract_start_date'=>$event->startDate,
            'contract_end_date'=>$end_date,
            'status'=>InviteStatus::Pending->value
        ]);
    }
}
