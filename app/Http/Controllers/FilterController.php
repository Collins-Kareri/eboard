<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Departments;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return [
            'department'=>Departments::all()->pluck('name'),
            'role'=>array_column(UserRole::cases(), 'value')
        ];
    }
}
