<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('dashboard', fn(User $user) => $user->isAdmin() || $user->isModer());
        Gate::define('edit-user', fn(User $user) => $user->isAdmin() || $user->isModer());
        Gate::define('edit-book', fn(User $user) => $user->isAdmin() || $user->isModer());
        Gate::define('edit-book', fn(User $user) => $user->isAdmin() || $user->isModer());
        Gate::define('create-book', fn(User $user) => $user->isAdmin() || $user->isModer());
        Gate::define('edit-author', fn(User $user) => $user->isAdmin() || $user->isModer());
        Gate::define('create-author', fn(User $user) => $user->isAdmin() || $user->isModer());
    }
}
