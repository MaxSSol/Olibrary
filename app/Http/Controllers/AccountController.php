<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        return view('authentication.account', ['user' => $request->user()]);
    }

    public function changeCredentials(Request $request)
    {
        if ($request->post()) {
            $this->updateCredentials($request);
            return redirect(route('account.account'));
        }
        return view('authentication.settings', ['user' => $request->user()]);
    }

    public function updateCredentials(Request $request)
    {
        $validated = $request->validate([
            'name' => 'max:50|unique:users,name',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        $user = $request->user();
        $user->fill(collect($validated)->filter()->all());
        $user->save();
    }
}
