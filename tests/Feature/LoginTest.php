<?php

use App\Providers\RouteServiceProvider;

beforeEach(function () {
    $department=department('hr');
    $this->user=user($department, [
        'email'=>'dev@eboard.com'
    ]);
});

test('redirects to login if unauthenticated', function () {
    $response=$this->get(RouteServiceProvider::HOME);
    $response->assertRedirect();
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
        'password'=>defaultPassword()
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
