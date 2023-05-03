<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Helpers\Calender;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/tasks', function () {
    return Inertia::render('Tasks');
})->name('tasks');

Route::prefix('/calender')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'daysAbbr'=>Calender::dayAbbreviations(),
            'monthNames'=>Calender::monthNames()
        ]);
    });

    Route::get('/{year}', function (int $year) {
        return response()->json(Calender::buildMonths($year));
    });
})->name('calender');

Route::get('/employees', function () {
    return Inertia::render('Employees');
})->name('employees');

Route::get('/employees', function () {
    return Inertia::render('Employees');
})->name('employees');


Route::get('/profile', function () {
    return Inertia::render('Profile');
})->name('profile');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
