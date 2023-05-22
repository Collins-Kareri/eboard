<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

beforeEach(function () {
    $department=department('hr');
    $this->user = user([
        'email_verified_at' => null
    ], $department);
});

test('email verification screen can be rendered', function () {
    $response = $this->actingAs($this->user)->get('/email/verify');

    $response->assertStatus(200);
});

test('email can be verified', function () {
    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $this->user->id, 'hash' => sha1($this->user->email)]
    );

    $response = $this->actingAs($this->user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    expect($this->user->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
});

test('email is not verified with invalid hash', function () {
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $this->user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($this->user)->get($verificationUrl);

    expect($this->user->fresh()->hasVerifiedEmail())->toBeFalse();
});
