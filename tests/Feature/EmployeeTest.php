<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->seed();
    $this->perPage=6;
    $this->page=1;
    $this->users=User::all();
});

test('cannot get employees if not manager', function () {
    $user=User::where('role', '=', UserRole::Member->value)->first();
    $response=$this->actingAs($user)->get(route('employees.index'));
    $response->assertForbidden();
});

test('get all employees if manager of department', function () {
    /**
     * Get a manager who is not part of hr department
     */
    $user=$this->users->whereNotInStrict('current_department', ['hr'])->firstWhere('role', UserRole::Manager->value);

    $response=$this->actingAs($user)->get(route('employees.index'));

    $employees=$this->users->filterOut([
        'current_department'=>$user->current_department
    ]);

    $employees=new LengthAwarePaginator(
        array_values($employees->sliding($this->perPage)->toArray()[$this->page-1]),
        $employees->count(),
        $this->perPage,
        $this->page
    );

    $response->assertOk();

    $response->assertInertia(fn (Assert $page) =>$page
    ->component('Employees')
    ->has(
        'employees',
        fn (Assert $page) =>$page
            ->where('data', $employees->items())
            ->etc()
    ));
});

test('HR manager can get all employees in the company', function () {
    /**
     * Get a manager who is not part of hr department
     */
    $user=User::where('role', '=', UserRole::Manager->value)->whereHas('departments', function (Builder $query) {
        $query->where('name', '=', 'hr');
    })
    ->first();

    $response=$this->actingAs($user)->get(route('employees.index'));


    $employees=$this->users;

    $employees=new LengthAwarePaginator(
        array_values($employees->sliding($this->perPage)->toArray()[$this->page-1]),
        $employees->count(),
        $this->perPage
    );

    $response->assertOk();

    $response->assertInertia(fn (Assert $page) =>$page
        ->component('Employees')
        ->has(
            'employees',
            fn (Assert $page) =>$page
                ->where('data', $employees->items())
                ->etc()
        ));
});

test('HR manager can filter results by department and roles', function ($department='', $role='') {
    /**
     * Get a manager who is not part of hr department
     */
    $user=User::where('role', '=', UserRole::Manager->value)->whereHas(
        'departments',
        function (Builder $query) {
            $query->where('name', '=', 'hr');
        }
    )->first();

    $response=$this->actingAs($user)->get(route('employees.index', [
        'department'=>$department,
        'role'=>$role
    ]));

    $users=$this->users;

    $employees=$users->filterOut([
        'role'=>$role,
        'current_department'=>$department
    ]);

    $employees=new LengthAwarePaginator(
        array_values($employees->sliding($this->perPage)->toArray()[$this->page-1]),
        $employees->count(),
        $this->perPage,
        $this->page
    );

    $response->assertOk();

    $response->assertInertia(fn (Assert $page) =>$page
        ->component('Employees')
        ->has(
            'employees',
            fn (Assert $page) =>$page
                ->where('data', $employees->items())
                ->etc()
        ));
})->with([
    'only departments'=>[
        'hr,it'
    ],
     'only roles'=>[
        '',
        'member'
     ],
      'departments and roles'=>[
        'hr,it',
        'manager'
    ]
]);
