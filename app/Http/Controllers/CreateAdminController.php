<?php

namespace App\Http\Controllers;

use App\Helpers\OnboardUser;
use App\Enums\UserRole;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CreateAdminController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Onboard/Register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        if(User::count()>=1) {
            return redirect()->route('home');
        }

        $user=OnboardUser::makeUser($request, UserRole::Manager->value, 'hr');

        event(new Registered($user));

        Auth::login($user, true);

        return redirect(RouteServiceProvider::HOME);
    }
}
