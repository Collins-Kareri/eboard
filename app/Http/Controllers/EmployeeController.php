<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewEmployees', User::class);

        $users=Cache::remember('users', 24*3600, function () {
            return User::all();
        });

        $user=$request->user();
        $department=$user->current_department;
        $employees=$users;
        $department_filter=$request->query('department');
        $page=$request->query('page')??"1";
        $role=$request->query('role');
        $perPage=6;

        if(Str::lower($department)==='hr') {
            /* get all users or filter them according to department name
                if department filters are provided
            */
            if(!is_null($department_filter)&&!\is_null($role)) {
                $employees=$users->whereIn('current_department', Str::of($department_filter)->explode(","))->whereIn('role', Str::of($department_filter)->explode(","));
            }

            if(!is_null($department_filter)) {
                $employees=$users->whereIn('current_department', Str::of($department_filter)->explode(","));
            }

            if(!is_null($role)) {
                $employees=$users->whereIn('current_department', Str::of($department_filter)->explode(","));
            }

        } else {
            $employees=$users->where('current_department', $department);

            if(!is_null($role)) {
                $employees=$users->whereIn('current_department', Str::of($department_filter)->explode(","))->where('current_department', $department);
            }
        }

        $employees=new LengthAwarePaginator($employees->sliding($perPage)[$page], $employees->count(), $perPage);

        return Inertia::render('Employees', [
            'employees' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
