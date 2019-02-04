<?php

namespace App\Providers;

use App\Enums\AdministrativeStatusEnum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-church-structure', function ($user) {
            return in_array(AdministrativeStatusEnum::ADMIN,
                $user->administrativeStatuses->pluck('status')->toArray());
        });

        Gate::define('manage-church-finance', function ($user) {
            return in_array(AdministrativeStatusEnum::FINANCIAL_OFFICER,
                $user->administrativeStatuses->pluck('status')->toArray());
        });
    }
}
