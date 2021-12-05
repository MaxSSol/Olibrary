<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('auth.account'));
        }
        return view('authentication.registration');
    }
    public function save(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:3|max:8|unique:users,name',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ]
        ]);
        $user = User::create($validated);

        if ($user) {
            Auth::login($user);
            return redirect(route('auth.account'));
        }
        return redirect(route('auth.registration'))->withErrors($validated)->withInput();
    }
}
