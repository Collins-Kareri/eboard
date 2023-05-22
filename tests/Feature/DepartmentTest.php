<?php

use App\Enums\InviteStatus;
use App\Enums\UserRole;
use App\Mail\DepartmentInvite;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

beforeEach(function () {
    $this->department=department('hr');
    $this->user=user($this->department, [
        'role'=>UserRole::Manager->value
    ]);
});

test('fails to create department if not manager', function () {
    $this->user->role=UserRole::Member->value;
    $this->user->save();

    $response=$this->actingAs($this->user)->post(route('department.store'), [
        'department_name'=>'finance',
        'manager_email'=>'test@mail.com'
    ]);

    $response->assertForbidden();

    $this->user->role=UserRole::Manager->value;
    $this->user->save();
});

test('can create a department if manager', function () {
    Mail::fake();

    $user=$this->user;

    $response=$this->actingAs($user)->post(route('department.store'), [
        'department_name'=>'finance',
        'manager_email'=>'test@mail.com'
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    $this->assertDatabaseHas('department_invitations', [
        'user_id'=>$user->id,
        'email'=>'test@mail.com',
        'status'=>InviteStatus::Pending->value
    ]);

    $inviteeEmail='test@mail.com';

    Mail::assertSent(DepartmentInvite::class, function (DepartmentInvite $mail) use ($inviteeEmail) {
        return $mail->hasTo($inviteeEmail);
    });
});

test('renders onboard screen while url is signed', function () {
    $email=fake()->email();
    $user=$this->user;

    $startTime=now();

    $user->departmentInvitations()->create([
        'email'=>$email,
        'role'=>UserRole::Member->value,
        'department_name'=>$this->department->name,
        'status'=>InviteStatus::Pending->value
    ]);

    $signedUrl=URL::temporarySignedRoute('user.create', $startTime->addHours(24), [
        'email'=>$email
    ]);

    $response=$this->get($signedUrl);
    $response->assertOk();
});

test('create a new department and its manager', function () {
    Mail::fake();

    $email='finance@mail.com';
    $role=UserRole::Manager->value;
    $department='finance';

    $user=$this->user;

    $user->sendInvite($email, $role, $department);

    $response=$this->post(route('user.store'), [
        'first_name'=>fake()->firstName(),
        'last_name'=>fake()->lastName(),
        'job_title'=>fake()->jobTitle(),
        'email'=>$email,
        'phone_number'=>fake()->phoneNumber(),
        'password'=>defaultPassword(),
        'department_name'=>$department
    ]);

    $response->assertRedirect();

    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'email'=>$email,
        'role'=>$role
    ]);

    $this->assertDatabaseHas('departments', [
        'name'=>$department
    ]);
});
