<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Helpers\Calender;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CreateAdminController;
use App\Http\Controllers\DepartmentInvitationController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCreateController;

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

// TODO refactor routes to appropriate controllers.

Route::middleware('guest')->group(function () {
    // login user
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('login', 'create')->name('login.create');
        Route::post('login', 'store')->name('login.store');
    });

    // request password request
    Route::controller(PasswordResetLinkController::class)->group(function () {
        Route::get('forgot-password', 'create')->name('password.request');
        Route::post('forgot-password', 'store')->name('password.request.email');
    });

    Route::controller(CreateAdminController::class)->group(function () {
        Route::get('/register', 'create')->name('register.create');
        Route::post('/register', 'store')->name('register.store');
    });

    // password reset
    Route::controller(NewPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'create')
                           ->name('password.reset');

        Route::post('reset-password', 'store')
                    ->name('password.store');
    });

    // register a new user
    Route::controller(UserCreateController::class)->group(function () {
        Route::get('/user/create/{email?}', 'create')->name('user.create');
        Route::post('/user/create', 'store')->name('user.store');
    });
});

Route::middleware('auth:web')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Home');
        })->name('home');

        Route::get('/tasks', function () {
            return Inertia::render('Tasks');
        })->name('tasks');

        Route::get('/department', function () {
            return Inertia::render('Department/Department');
        })->name('department');

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

        Route::Resource('employees', EmployeeController::class);

        Route::get('/filters', FilterController::class)->name('filters');

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });

        Route::delete('/avatar', function (Request $request) {
            $request->user()->deleteAvatar();
            return redirect()->route('profile.update');
        })->name('avatar.destroy');

        Route::Resource('departments', DepartmentsController::class);

        Route::controller(DepartmentInvitationController::class)->group(function () {
            Route::post('/department/member', 'store')->name('department.invite');
        });

        Route::put('/password', [PasswordController::class,'update'])->name('password.update');
    });

    Route::get('/email/verify', EmailVerificationPromptController::class)->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class,'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
