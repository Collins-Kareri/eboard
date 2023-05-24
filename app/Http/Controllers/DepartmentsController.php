<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Departments;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class DepartmentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('sendInvite', User::class);

        $request->validateWithBag('create_department', [
            'department_name'=>['unique:departments,name','required','string'],
            'manager_email'=>['required','unique:users,email','string','email']
        ]);

        $request->user()->sendInvite($request->input('manager_email'), UserRole::Manager->value, $request->input('department_name'));

        return back();
    }
}
