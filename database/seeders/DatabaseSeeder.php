<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRole;
use App\Models\Departments;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Departments::factory()->count(5)->sequence(
            ['name'=>'hr'],
            ['name'=>'finance'],
            ['name'=>'it'],
            ['name'=>'marketing'],
            ['name'=>'operations management']
        )->create();

        $department_ids=Departments::all()->modelKeys();
        $roles=array_column(UserRole::cases(), 'value');

        for($count=1;$count<=80;$count++) {
            User::factory()->state(
                new Sequence(
                    fn () =>[
                        'role'=>Arr::random($roles),
                        'departments_id'=>Arr::random($department_ids)
                    ]
                )
            )
                    ->create([
                        'first_name'=>fake()->firstName(),
                        'last_name'=>fake()->lastName(),
                        'email'=>fake()->unique()->safeEmail(),
                        'job_title'=>fake()->jobTitle(),
                    ]);

        }


        // User::factory()->for(Departments::factory()->state([
        //     'name'=>'hr'
        // ]))
        // ->create([
        //     'first_name'=>'John',
        //     'last_name'=>'Doe',
        //     'email'=>'johnDoe@mail.com',
        //     'job_title'=>'hr manager',
        //     'role'=>UserRole::Manager->value
        // ]);
    }
}
