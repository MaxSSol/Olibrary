<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $user = User::findOrFail($request->post('id'));
            $this->authorize('update', $user);
            $user->name = $request->post('name');
            $user->email = $request->post('email');
            $user->save();
            if ($request->post('role')) {
                $user->roles()->detach();
                $role = Role::findOrFail($request->post('role'));
                $role->users()->save($user);
            }
        }
    }

    public function ban(Request $request)
    {
        $user = User::findOrFail($request->get('id'));
        $this->authorize('ban', $user);
        $user->banned = 1;
        $user->save();
        return redirect(route('admin.dashboard'));
    }

    public function unban(Request $request)
    {
        $user = User::findOrFail($request->get('id'));
        $this->authorize('unban', $user);
        $user->banned = 0;
        $user->save();
        return redirect(route('admin.dashboard'));
    }
}
