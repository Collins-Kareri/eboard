<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Helpers\Calender;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;

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

Route::middleware('guest')->group(function () {
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('login', 'create')->name('login.create');
        Route::post('login', 'store')->name('login.store');

    });

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                    ->name('password.request');
});

Route::middleware('auth')->group(function () {
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

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::delete('/avatar', function (Request $request) {
        $request->user()->deleteAvatar();
        return redirect()->route('profile.update');
    })->name('avatar.destory');

    Route::put('/password', [PasswordController::class,'update'])->name('password.update');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
