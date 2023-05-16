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
    $this->defaultPassword="s£cReT123";
});

it('Redirects to register page if no admin is available', function () {
    $response=$this->get(route('home'));
    $response->assertRedirectToRoute('register.create');
});

it('Can register a new admin who is the manager of hr department', function (string $email, string $role) {
    $response=$this->post(route('register.store'), [
        'first_name'=>fake()->firstName(),
        'last_name'=>fake()->lastName(),
        'job_title'=>fake()->jobTitle(),
        'email'=>$email,
        'phone_number'=>fake()->phoneNumber(),
        'password'=>$this->defaultPassword,
        'role'=>$role,
    ]);

    $this->assertAuthenticated();

    $response->assertRedirect(RouteServiceProvider::HOME);

    $this->assertDatabaseHas('users', [
        'email'=>$email,
        'role'=>$role,
        'departments_id'=>$this->department->id,
        'employeeID'=>'EB-1'
    ]);

})->with([
    'manager'=>[fake()->email(),UserRole::Manager->value]
]);

it('cannot register user without invitation', function (string $email, string $role, $contractStart=null, $contractPeriod=null) {
    User::factory()->state([
        'role'=>UserRole::Manager->value
    ])->for($this->department)->create();

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
        'password'=>$this->defaultPassword,
        'role'=>$role,
        'contract_start_date'=>$contractStart,
        'contract_end_date'=>$contractEnd,
        'department_name'=>$this->department->name
    ]);

    $response->assertInvalid(['email'=>'not found']);
})->with('userdata');

it('user is registered and logged in only if invitation is sent', function (string $email, string $role, $contractStart=null, $contractPeriod=null) {

    $user=User::factory()->state([
        'role'=>UserRole::Manager->value
    ])->for($this->department)->create();

    DepartmentInviteSent::dispatch($email, $user);

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
        'password'=>$this->defaultPassword,
        'role'=>$role,
        'contract_start_date'=>$contractStart,
        'contract_end_date'=>$contractEnd,
        'department_name'=>$this->department->name
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
