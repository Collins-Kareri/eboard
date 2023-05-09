<?php

use App\Models\User;
use App\Models\Departments;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('profile page is displayed', function () {
    $user = User::factory()->for(Departments::factory()->state([
            'name'=>'hr'
        ]), 'memberOf')->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->for(Departments::factory()->state([
            'name'=>'hr'
        ]), 'memberOf')->create();


    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'avatar'=>UploadedFile::fake()->image('test.jpg'),
            'phone_number'=>'+25412345678'
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Test User', $user->full_name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
    $this->assertNotNull($user->avatar);

    Storage::delete([$user->avatar]);
});

test('profile can be delete if not department manager', function () {
    $user = User::factory()->state([
        'password'=>'secret'
    ])->for(Departments::factory()->state([
            'name'=>'hr'
        ]), 'memberOf')->create();


    $this
        ->actingAs($user)
        ->delete('/profile', [
            'password'=>'secret',
            'owns_department'=>$user->owns_department
        ]);

    expect($user->fresh()->count())->toEqual(1);
});

test('correct password must be provided before account can be deleted', function () {
    $this->actingAs($user = User::factory()->for(Departments::factory()->state([
            'name'=>'hr'
        ]), 'memberOf')->create());

    $response = $this->delete('/user', [
        'password' => 'wrong-password',
    ]);

    expect($user->fresh())->not->toBeNull();
});
