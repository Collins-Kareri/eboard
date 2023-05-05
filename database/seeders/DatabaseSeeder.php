<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Departments;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->for(Departments::factory()->state([
            'name'=>'hr'
        ]), 'memberOf')
        ->create([
            'first_name'=>'John',
            'last_name'=>'Doe',
            'email'=>'johnDoe@mail.com',
            'job_title'=>'hr manager',
            'password'=>Hash::make('secret'),
            'owns_department'=>true
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
