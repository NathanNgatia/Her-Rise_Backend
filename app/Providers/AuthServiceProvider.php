<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    // Removed duplicate boot method
    public function boot(): void
    {
        $this->registerPolicies();

        // Define gates for User
        Gate::define('view-dashboard', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('update-users', function (User $user, User $targetUser) {
            return $user->id === $targetUser->id || $user->isAdmin();
        });

    }
}
