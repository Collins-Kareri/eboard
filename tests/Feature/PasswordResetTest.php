<?php

use App\Models\Departments;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    $department=Departments::factory()->state([
        'name'=>'hr'
    ])->create();
    $this->user = User::factory()->for($department)->create();
});

it('reset password link screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
});

it('reset password link can be requested', function () {
    Notification::fake();

    $this->post('/forgot-password', ['email' => $this->user->email]);

    Notification::assertSentTo($this->user, ResetPassword::class);
});

it('reset password screen can be rendered', function () {
    Notification::fake();

    $this->post('/forgot-password', ['email' => $this->user->email]);

    Notification::assertSentTo($this->user, ResetPassword::class, function ($notification) {
        $response = $this->get('/reset-password/'.$notification->token);

        $response->assertStatus(200);

        return true;
    });
});

it('password can be reset with valid token', function () {
    Notification::fake();

    $user = $this->user;

    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        $response = $this->post('/reset-password', [
            'token' => $notification->token,
            'email' => $user->email,
            'password' => 's£cReT123',
            'password_confirmation' => 's£cReT123',
        ]);

        $response->assertSessionHasNoErrors();

        return true;
    });
});
