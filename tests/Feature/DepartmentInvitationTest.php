<?php

use App\Enums\UserRole;
use App\Enums\InviteStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepartmentInvite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    Mail::fake();
    $this->department=department('hr');
    $this->user=user($this->department, [
        'role'=>UserRole::Manager->value
    ]);
    $this->inviteeEmail=fake()->email();
    $this->startTime=now();
});

test('Can only send invite if manager', function () {
    $this->user->role=UserRole::Member->value;
    $this->user->save();

    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value,
        'department_name'=>$this->department->name
    ]);

    $response->assertForbidden();

    $this->user->role=UserRole::Manager->value;
    $this->user->save();
});

test('Manager can invite new members', function () {
    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value,
        'department_name'=>$this->department->name
    ]);

    $response->assertRedirect();
});

test('Invitation is stored', function () {
    // department.invite
    $this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value,
        'department_name'=>$this->department->name
    ]);

    $this->assertDatabaseHas('department_invitations', [
        'user_id'=>$this->user->id,
        'email'=>$this->inviteeEmail,
        'department_name'=>$this->department->name,
        'status'=>InviteStatus::Pending->value
    ]);
});

test('Fails to send invite if email is already sent', function () {
    $this->user->departmentInvitations()->create([
        'email'=>$this->inviteeEmail,
        'department_name'=>$this->department->name,
        'role'=>UserRole::Member->value
    ]);

    $this->assertDatabaseHas('department_invitations', [
        'user_id'=>$this->user->id,
        'email'=>$this->inviteeEmail,
        'status'=>InviteStatus::Pending->value
    ]);

    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value,
        'department_name'=>$this->department->name
    ]);

    $response->assertSessionHasErrorsIn('invite', [
        'email'=>'Invitation already sent, please wait for 24 hours before sending another invitation or invalidate previous one to send  a new one.'
    ]);
});

test('mail is sent to invitee', function () {
    Event::fake();

    $this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value,
        'department_name'=>$this->department->name
    ]);

    $inviteeEmail=$this->inviteeEmail;

    Mail::assertSent(DepartmentInvite::class, function (DepartmentInvite $mail) use ($inviteeEmail) {
        return $mail->hasTo($inviteeEmail);
    });
});

test('sends invites to members and contractors', function (string $email, string $role, $start_time=null, $contract_period=null) {
    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$email,
        'role'=>$role,
        'start_time'=>$start_time,
        'contract_period'=>$contract_period,
        'department_name'=>$this->department->name
    ]);

    $response->assertRedirect();
})->with([
    'member'=>[fake()->email(),UserRole::Member->value],
    'contractor'=>[fake()->email(),UserRole::Contractor->value,Carbon::now('utc'),'6 day']
]);

test('fails to invite contractors if wrong values are provided contract details', function (string $email, string $role, $start_time=null, $contract_period=null) {
    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$email,
        'role'=>$role,
        'start_time'=>$start_time,
        'contract_period'=>$contract_period,
        'department_name'=>$this->department->name
    ]);

    $response->assertInvalid();
})->with([
    'missing attributes'=>[fake()->email(),UserRole::Contractor->value],
    'wrong time period'=>[fake()->email(),UserRole::Contractor->value,Carbon::now('utc'),'6 days'],
    'invalid start time'=>[fake()->email(),UserRole::Contractor->value,'de','6 day'],
    'wrong data types'=>[fake()->email(),UserRole::Contractor->value,'dude','unknown format']
]);
