<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\DepartmentInvitation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Profile', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $input=$request->validated();

        $names=Str::of($input['full_name'])->explode(" ");

        if($request->hasFile('avatar')) {
            $avatar=$request->file('avatar');
            $request->user()->updateAvatar($avatar);
        }

        $request->user()->fill([
            'first_name'=>$names[0],
            'last_name'=>$names[1],
            'email'=>$input['email'],
            'phone_number'=>$input['phone_number']
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
            $request->user()->sendEmailVerificationNotification();
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'password' => ['required', 'current_password'],
            'role'=>['string',Rule::in([UserRole::Member->value, UserRole::Contractor->value])]
        ], [
            'declined'=>'Delete account operation not available to department owners'
        ])->validateWithBag('deleteAccount');

        DepartmentInvitation::where('email', '=', $request->user()->email)->delete();

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
