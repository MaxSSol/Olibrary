<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        Gate::authorize('edit-user', $user);
        $roles = Role::all();
        return view('admin.user-update', compact('user', 'roles'));
    }
    public function update(UpdateUserRequest $request, $id)
    {
            $user = User::findOrFail($id);
            $this->authorize('update', $user);
            $userData = collect($request->only(['email','name','password']))->whereNotNull()->toArray();
            $user->update($userData);
            $user->roles()->detach();
            $user->roles()->attach($request->role);

            return redirect(route('admin.user.edit', $id));
    }

    public function ban(Request $request)
    {
        $user = User::findOrFail($request->get('id'));
        $this->authorize('ban', $user);
        $user->banned = 1;
        $user->save();
        return redirect(route('admin.dashboard'));
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function unban(Request $request)
    {
        $user = User::findOrFail($request->get('id'));
        $this->authorize('unban', $user);
        $user->banned = 0;
        $user->save();
        return redirect(route('admin.dashboard'));
    }
}
