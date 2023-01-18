<?php

namespace App\Providers;

use App\Services\Roles\{RoleInterface, RoleService};
use App\Services\PaymentMethods\{PaymentMethodInterface, PaymentMethodService};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleInterface::class, RoleService::class);
        // $this->app->bind(PermissionInterface::class, PermissionService::class);
        $this->app->bind(PaymentMethodInterface::class, PaymentMethodService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
