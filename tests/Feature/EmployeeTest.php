<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->seed();
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
    $user=User::where('role', '=', UserRole::Manager->value)
    ->whereHas('departments', function (Builder $query) {
        $query->whereNot('name', '=', 'hr');
    })
    ->first();

    $response=$this->actingAs($user)->get(route('employees.index'));

    $employees=User::where('departments_id', '=', $user->departments_id)->paginate(6);

    $response->assertOk();

    $response->assertInertia(fn (Assert $page) =>$page
    ->component('Employees')
    ->has(
        'employees',
        fn (Assert $page) =>$page
            ->where('data', $employees->toArray()['data'])
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

    $employees=User::paginate(6);

    $response->assertOk();

    $response->assertInertia(fn (Assert $page) =>$page
        ->component('Employees')
        ->has(
            'employees',
            fn (Assert $page) =>$page
                ->where('data', $employees->toArray()['data'])
                ->etc()
        ));
});

test('HR manager can filter results by department', function () {
    /**
     * Get a manager who is not part of hr department
     */
    $user=User::where('role', '=', UserRole::Manager->value)->whereHas('departments', function (Builder $query) {
        $query->where('name', '=', 'hr');
    })
    ->first();

    $department_filter="hr,it";

    $response=$this->actingAs($user)->get(route('employees.index', [
        'department'=>$department_filter
    ]));

    $employees=User::whereHas('departments', function (Builder $query) use ($department_filter) {
        $query->whereIn('name', Str::of($department_filter)->split('/,/'));
    })->paginate(6);

    $response->assertOk();

    $response->assertInertia(fn (Assert $page) =>$page
        ->component('Employees')
        ->has(
            'employees',
            fn (Assert $page) =>$page
                ->where('data', $employees->toArray()['data'])
                ->etc()
        ));
});
