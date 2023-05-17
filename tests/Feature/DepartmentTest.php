<?php

use App\Enums\InviteStatus;
use App\Enums\UserRole;
use App\Mail\DepartmentInvite;
use App\Models\Departments;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

beforeEach(function () {
    $this->department=Departments::factory()->state([
        'name'=>'hr'
    ])->create();
    $this->defaultPassword="s£cReT123";
});

test('fails to create department if not manager', function () {
    $user=User::factory()->for($this->department)->create();

    $response=$this->actingAs($user)->post(route('department.store'), [
        'department_name'=>'finance',
        'manager_email'=>'test@mail.com'
    ]);

    $response->assertForbidden();
});

test('can create a department if manager', function () {
    Mail::fake();

    $user=User::factory()->for($this->department)->state([
        'role'=>UserRole::Manager->value
    ])->create();

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
    $startTime=now();

    $signedUrl=URL::temporarySignedRoute('register.create', $startTime->addHours(24), [
        'email'=>fake()->email(),
        'role'=>UserRole::Manager->value
    ]);

    $response=$this->get($signedUrl);
    $response->assertOk();
});

test('create a new department and its manager', function () {
    Mail::fake();
    $email='finance@mail.com';
    $role=UserRole::Manager->value;
    $department='finance';

    $user=User::factory()->for($this->department)->state([
        'role'=>UserRole::Manager->value
    ])->create();

    $user->sendInvite($email, $role, $department);

    $response=$this->post(route('onboard.store'), [
        'first_name'=>fake()->firstName(),
        'last_name'=>fake()->lastName(),
        'job_title'=>fake()->jobTitle(),
        'email'=>$email,
        'phone_number'=>fake()->phoneNumber(),
        'password'=>$this->defaultPassword,
        'role'=>$role,
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
