<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('account.account'));
        }
        $role = Role::where('slug', 'user')->value('id');
        return view('authentication.registration', ['role' => $role]);
    }
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        $user->roles()->attach($request->role);

        event(new Registered($user));

        if ($user) {
            Auth::login($user);
            return redirect(route('account.account'));
        }
        return redirect(route('auth.registration'))->withErrors($request)->withInput();
    }
}
