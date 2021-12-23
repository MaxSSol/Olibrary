<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class AdminUserActivityModal extends Component
{
    public $user;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = User::findOrFail($user);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-user-activity-modal', ['user' => $this->user]);
    }
}
