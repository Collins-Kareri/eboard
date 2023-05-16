<?php

use App\Models\User;
use App\Models\Departments;
use App\Enums\UserRole;
use App\Enums\InviteStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepartmentInvite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    Mail::fake();
    $this->user=User::factory()->state([
        'role'=>UserRole::Manager->value
    ])->for(Departments::factory()->state([
        'name'=>'hr'
    ]))->create();
    $this->inviteeEmail=fake()->email();
    $this->startTime=now();
});

it('Can only send invite if manager', function () {
    $this->user->role=UserRole::Member->value;
    $this->user->save();

    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value
    ]);

    $response->assertForbidden();

    $this->user->role=UserRole::Manager->value;
    $this->user->save();

});

it('Manager can invite new members', function () {

    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value
    ]);

    $response->assertRedirect();
});

it('Invitation is stored', function () {
    $this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value
    ]);

    $this->assertDatabaseHas('department_invitations', [
            'user_id'=>$this->user->id,
            'email'=>$this->inviteeEmail,
            'status'=>InviteStatus::Pending->value
        ]);
});

it('mail is sent to invitee', function () {
    Event::fake();

    $this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value
    ]);

    $inviteeEmail=$this->inviteeEmail;

    Mail::assertSent(DepartmentInvite::class, function (DepartmentInvite $mail) use ($inviteeEmail) {
        return $mail->hasTo($inviteeEmail);
    });
});

it('sends invites to members and contractors', function (string $email, string $role, $start_time=null, $contract_period=null) {
    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$email,
        'role'=>$role,
        'start_time'=>$start_time,
        'contract_period'=>$contract_period
    ]);

    $response->assertRedirect();
})->with([
    'member'=>[fake()->email(),UserRole::Member->value],
    'contractor'=>[fake()->email(),UserRole::Contractor->value,Carbon::now('utc'),'6 day']
]);

it('fails to invite contractors if wrong values are provided contract details', function (string $email, string $role, $start_time=null, $contract_period=null) {
    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$email,
        'role'=>$role,
        'start_time'=>$start_time,
        'contract_period'=>$contract_period
    ]);

    $response->assertInvalid();
})->with([
    'missing attributes'=>[fake()->email(),UserRole::Contractor->value],
    'wrong time period'=>[fake()->email(),UserRole::Contractor->value,Carbon::now('utc'),'6 days'],
    'invalid start time'=>[fake()->email(),UserRole::Contractor->value,'de','6 day'],
    'wrong data types'=>[fake()->email(),UserRole::Contractor->value,'dude','unknown format']
]);
