<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        if (Schema::hasTable('permissions')) {
            $permissions = Permission::with('groups')->get();
            foreach ($permissions as $permission) {
                Gate::define($permission->code, function($user) use ($permission) {
                    return $user->hasGroup($permission->groups->pluck('id'));
                });
            }
        }
    }
}
