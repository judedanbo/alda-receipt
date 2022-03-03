<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function change(Request $request)
    {
        return view('auth.change-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:8|password',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user  =  User::find(Auth::user()->id);
        $user->password = Hash::make($request->password) ;
        $user->save();
        Auth::logout();
        Auth::logoutOtherDevices($request->password);
        return redirect()->route('login');

        // $status = Password::reset(
        //     $request->only( 'password', 'password_confirmation'),
        //     function ($user) use ($request) {
        //         $user->forceFill([
        //             'password' => Hash::make($request->password),
        //             'remember_token' => Str::random(60),
        //             ])->save();
        //         }
        // );


        // return $status == Password::PASSWORD_RESET
        // ? redirect()->route('login')->with('status', __($status))
        // : back()->withInput($request->only('username'))
        // ->withErrors(['username' => __($status)]);
        }
}