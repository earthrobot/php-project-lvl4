<?php

namespace App\Providers;

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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('crud-status', function (\App\Models\User $user) {
            return true;
        });

        // Gate::define('delete-status', function (User $user, TaskStatus $taskStatus) {
        //     //return $user->id === $taskStatus->user_id;
        //     return $taskStatus->creator->is($user);
        // });
    }
}
