<?php

namespace App\View\Components;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\Component;

class AdminUserModal extends Component
{

    public $user;
    public $roles;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = User::findOrFail($user);
        $this->roles = Role::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-user-modal', ['user' => $this->user, 'roles' => $this->roles]);
    }
}
