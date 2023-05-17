<?php

use App\Models\User;
use App\Models\Departments;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user=User::factory()->for(Departments::factory()->state([
            'name'=>'hr'
        ]))->create();
});

it('profile page is displayed', function () {
    $response = $this
        ->actingAs($this->user)
        ->get('/profile');

    $response->assertOk();
});

it('requests for verification on email change', function () {
    Notification::fake();
    $response = $this
            ->actingAs($this->user)
            ->patch('/profile', [
                'full_name' => 'Test User',
                'email' => fake()->email(),
                'avatar'=>UploadedFile::fake()->image('test.jpg'),
                'phone_number'=>'+25412345678'
            ]);

    $response->assertRedirect();
    $this->user->refresh();
    expect($this->user->hasVerifiedEmail())->toBeFalse();
    Notification::assertSentTo($this->user, VerifyEmail::class);
});

it('fails update on wrong data', function (string $full_name=null, string $email, $avatar=null, string $phone_number) {
    $response = $this
        ->actingAs($this->user)
        ->patch('/profile', [
            'full_name' => $full_name,
            'email' => $email,
            'avatar'=>$avatar,
            'phone_number'=>$phone_number
        ]);

    $response->assertSessionHasErrorsIn('updateProfileInformation');
})->with([
    'missing full name'=>[null,fake()->email(),null,'+'.fake()->phoneNumber()],
    'invalid email'=>[fake()->name(),'due',null,'+'.fake()->phoneNumber()],
    'invalid avatar'=>[fake()->name(),'due',UploadedFile::fake()->image('test.avif'),'+'.fake()->phoneNumber()],
    'invalid phone number'=>[fake()->name(),'due',UploadedFile::fake()->image('test.avif'),'+'.fake()->phoneNumber().'d']
]);

it('profile information can be updated', function () {
    $response = $this
        ->actingAs($this->user)
        ->patch('/profile', [
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'avatar'=>UploadedFile::fake()->image('test.jpg'),
            'phone_number'=>'+25412345678'
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->user->refresh();

    $this->assertSame('Test User', $this->user->full_name);
    $this->assertSame('test@example.com', $this->user->email);
    $this->assertNull($this->user->email_verified_at);
    $this->assertNotNull($this->user->avatar);

    Storage::delete([$this->user->avatar]);
});

it('profile can be deleted if not department manager', function () {
    $this
        ->actingAs($this->user)
        ->delete('/profile', [
            'password'=>'secret',
            'role'=>$this->user->role
        ]);

    expect($this->user->fresh()->count())->toEqual(1);
});

it('correct password must be provided before account can be deleted', function () {
    $this->actingAs($this->user);

    $this->delete('/user', [
        'password' => 'wrong-password',
    ]);

    expect($this->user->fresh())->not->toBeNull();
});
