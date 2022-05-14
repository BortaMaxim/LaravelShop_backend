<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isAdmin', function ($user) {
            return $user->roles === 'admin';
        });

        Gate::define('isManager', function ($user) {
            return $user->roles === 'manager';
        });


        if (!$this->app->routesAreCached()) {
            Passport::routes();
            Passport::tokensExpireIn(now()->addDays(1));
        }
    }
}
