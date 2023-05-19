<?php

use App\Enums\UserRole;
use App\Models\Departments;

beforeEach(function () {
    $this->defaultPassword="s£cReT123";
});

test('Redirects to register page if no admin is available', function () {
    $response=$this->get(route('home'));
    $response->assertRedirectToRoute('register.create');
});

test('Can register a new admin who is the manager of hr department', function (string $email, string $role) {
    $response=$this->post(route('register.store'), [
        'first_name'=>fake()->firstName(),
        'last_name'=>fake()->lastName(),
        'job_title'=>fake()->jobTitle(),
        'email'=>$email,
        'phone_number'=>fake()->phoneNumber(),
        'password'=>$this->defaultPassword
    ]);

    $response->assertRedirectToRoute('home');

    $this->assertAuthenticated();

    $department=Departments::where('name', '=', 'hr')->first();

    $this->assertDatabaseHas('users', [
        'email'=>$email,
        'role'=>$role,
        'departments_id'=>$department->id,
    ]);
})->with([
    'manager'=>[fake()->email(),UserRole::Manager->value]
]);
