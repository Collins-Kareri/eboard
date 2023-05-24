<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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

        $user=$request->user();
        $department=$user->current_department;
        $employees=[];
        $department_filter=$request->query('department');

        if(Str::lower($department)==='hr') {
            /* get all users or filter them according to department name
                if department filters are provided
            */
            $employees=is_null($department_filter) ? User::paginate(6)
            : User::whereHas('departments', function (Builder $query) use ($department_filter) {
                $query->whereIn('name', Str::of($department_filter)
                ->split('/,/'));
            })->paginate(6);
        } else {
            $employees=User::where('departments_id', '=', $user->departments->id)
            ->paginate(6);
        }

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
