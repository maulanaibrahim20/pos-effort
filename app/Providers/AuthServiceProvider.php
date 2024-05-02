<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Auth\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define("super_admin", function ($user) {
            if (empty($user->akses)) {
                return redirect("/logout");
            } else {
                return $user->akses == 1;
            }
        });
        Gate::define("admin", function ($user) {
            if (empty($user->akses)) {
                return redirect("/logout");
            } else {
                return $user->akses == 2;
            }
        });
        Gate::define("karyawan", function ($user) {
            if (empty($user->akses)) {
                return redirect("/logout");
            } else {
                return $user->akses == 3;
            }
        });
    }
}
