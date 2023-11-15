<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

        $currentPage=$request->query("page")??"1";
        $userDepartment=$request->user()->current_department;

        $users=Cache::remember('users', 24*3600, function () {
            return User::all();
        });

        $role_filters=$request->query('role');
        $department_filters=$request->query('department');

        if($userDepartment==="hr") {
            $users=$users->filterOut([
                'role'=>$role_filters,
                'current_department'=>$department_filters
            ]);
        } else {
            $users=$users->filterOut([
                'role'=>$role_filters,
                'current_department'=>$userDepartment
            ]);
        }

        $total=$users->count();
        $currentItems=array_values($users->toArray());
        $perPage=6;

        if($total>$perPage) {
            $currentItems=array_values($users->sliding($perPage)->toArray()[(int)$currentPage-1]);
        }

        $employees=new LengthAwarePaginator($currentItems, $total, $perPage, $currentPage, [
            'path'=>$request->path(),
            'query'=>$request->all()
        ]);

        //todo add logic that adds each department manager to returned results.

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
