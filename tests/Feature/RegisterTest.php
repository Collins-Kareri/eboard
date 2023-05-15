<?php

use App\Helpers\Calender;
use App\Events\DepartmentInviteSent;
use App\Providers\RouteServiceProvider;
use App\Models\Departments;
use App\Models\User;
use App\Enums\UserRole;

beforeEach(function () {
    $this->department=Departments::factory()->state([
        'name'=>'hr'
    ])->create();

    $this->user=User::factory()->state([
            'role'=>UserRole::Manager->value
        ])->for($this->department)->create();

});

test('cannot register user without invitation', function (string $email, string $role, $contractStart=null, $contractPeriod=null) {

    $contractEnd=null;

    $response=$this->post(route('register.store'), [
        'first_name'=>fake()->firstName(),
        'last_name'=>fake()->lastName(),
        'job_title'=>fake()->jobTitle(),
        'email'=>$email,
        'phone_number'=>fake()->phoneNumber(),
        'password'=>fake()->password(8),
        'role'=>$role,
        'contract_start_date'=>$contractStart,
        'contract_end_date'=>$contractEnd,
        'department_id'=>$this->department->id
    ]);

    $response->assertInvalid(['email'=>'not found']);
})->with('userdata');

test('user is registered and logged in only if invitation is sent', function (string $email, string $role, $contractStart=null, $contractPeriod=null) {

    DepartmentInviteSent::dispatch($email, $this->user);

    $contractEnd=null;

    if(!is_null($contractStart)) {
        $contractEnd=Calender::endDate($contractStart, $contractPeriod);
    }

    $response=$this->post(route('register.store'), [
        'first_name'=>fake()->firstName(),
        'last_name'=>fake()->lastName(),
        'job_title'=>fake()->jobTitle(),
        'email'=>$email,
        'phone_number'=>fake()->phoneNumber(),
        'password'=>fake()->password(8),
        'role'=>$role,
        'contract_start_date'=>$contractStart,
        'contract_end_date'=>$contractEnd,
        'department_id'=>$this->department->id
    ]);

    $this->assertAuthenticated();

    $response->assertRedirect(RouteServiceProvider::HOME);

    $this->assertDatabaseHas('users', [
        'email'=>$email,
        'contract_start_date'=>$contractStart,
        'contract_end_date'=>$contractEnd,
        'role'=>$role
    ]);
})->with('userdata');
