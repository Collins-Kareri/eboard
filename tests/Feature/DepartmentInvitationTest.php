<?php

use App\Models\User;
use App\Models\Departments;
use App\Enums\UserRole;
use App\Enums\InviteStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepartmentInvite;
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

    $this->response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value
    ]);
});

test('Can only send invite if manager', function () {
    $this->user->role=UserRole::Member->value;
    $this->user->save();

    $response=$this->actingAs($this->user)->post(route('department.invite'), [
        'email'=>$this->inviteeEmail,
        'role'=>UserRole::Member->value
    ]);

    $response->assertStatus(403);

    $this->user->role=UserRole::Manager->value;
    $this->user->save();

});

test('Manager can invite new members', function () {
    $this->response->assertStatus(302);
});

test('Invitation is stored', function () {
    $this->assertDatabaseHas('department_invitations', [
            'user_id'=>$this->user->id,
            'email'=>$this->inviteeEmail,
            'status'=>InviteStatus::Pending->value
        ]);
});

test('mail is sent to invitee', function () {
    Event::fake();
    $inviteeEmail=$this->inviteeEmail;

    Mail::assertSent(DepartmentInvite::class, function (DepartmentInvite $mail) use ($inviteeEmail) {
        return $mail->hasTo($inviteeEmail);
    });
});
