<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('account.account'));
        }

        return view('authentication.login');
    }

    public function login(Request $request)
    {
        $validate = $request->only(['email', 'password']);
        $remember = $request->post('remember');

        if (Auth::attempt($validate, $remember)) {
            return redirect(route('account.account'));
        }

        return redirect(route('auth.login'))->withErrors([
            'formErrors' => 'Check your data'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle()
    {
        $user = Socialite::driver('google')->user();
        $existingUser = User::where('google_id', $user->id)->first();

        if (!$existingUser) {
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Str::random(16),
                'google_id' => $user->getId(),
            ]);

            Auth::login($newUser);
            return redirect(route('account.account'));
        }
        Auth::login($existingUser);
        return redirect(route('account.account'));
    }
}
