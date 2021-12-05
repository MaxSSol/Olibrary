<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('auth.account'));
        }

        return view('authentication.login');
    }

    public function login(Request $request)
    {
        $validate = $request->only(['email', 'password']);
        $remember = $request->post('remember');

        if (Auth::attempt($validate, $remember)) {
            return redirect(route('auth.account'));
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
}
