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
use App\Http\Controllers\DepartmentInvitationController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\OnBoardingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

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


    Route::controller(OnBoardingController::class)->group(function () {
        Route::get('/onboard/{email?}/{role?}/{department?}', 'create')->name('onboard.create');
        Route::post('/onboard', 'store')->name('onboard.store');
    });

    // password reset
    Route::controller(NewPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'create')
                           ->name('password.reset');

        Route::post('reset-password', 'store')
                    ->name('password.store');
    });

    // register a new user
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register/{email?}/{role?}', 'create')->name('register.create');
        Route::post('/register', 'store')->name('register.store');
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
        })->name('avatar.destroy');

        Route::controller(DepartmentsController::class)->group(function () {
            Route::get('/department', 'index')->name('department');
            Route::post('/department', 'store')->name('department.store');
        });

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
