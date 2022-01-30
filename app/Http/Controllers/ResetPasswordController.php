<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function show()
    {
        return view('authentication.forgot-password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request, PasswordBroker $password)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->only('email'))->first();
        $status = '';
        if ($user) {
            $token = $password->createToken($user);
            $user->sendPasswordResetNotification($token);
            $status = 'Password reset link sent';
        }

        return $status === 'Password reset link sent'
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => 'Check your email']);
    }

    public function edit($token)
    {
        return view('authentication.reset-password', ['token' => $token]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
