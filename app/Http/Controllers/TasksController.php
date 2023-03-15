<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = app('current_user');
        $current_date = Carbon::today()->format('Y-m-d');
        return $user->tasks;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Carbon $current_date)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
