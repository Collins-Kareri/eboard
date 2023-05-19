<?php

use App\Models\Departments;
use App\Models\User;
use App\Providers\RouteServiceProvider;

beforeEach(function () {
    $this->departments=Departments::factory()->state([
        'name'=>'hr'
    ])->create();
    $this->user=User::factory()->state([
        'email'=>'dev@eboard.com'
    ])->for($this->departments)->create();
});

test('redirects to login if unauthenticated', function () {
    $response=$this->get(RouteServiceProvider::HOME);

    $response->assertRedirect(route('login.create'));
});

test("Fails login with wrong credentials", function (string $email, string $password) {
    $response=$this->post(route('login.store'), [
        'email'=>$email,
        'password'=>$password
    ]);

    $response->assertInvalid();
})->with([
    'wrong email'=>['nonexistant@mail.com','s£cRet123'],
    'invalid password'=>['dev@eboard.com','wrong_password']
]);


test('Logs in user', function () {
    $response=$this->post(route('login.store'), [
        'email'=>$this->user->email,
        'password'=>'s£cReT123'
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
