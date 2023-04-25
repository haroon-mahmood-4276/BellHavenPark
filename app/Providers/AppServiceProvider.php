<?php

namespace App\Providers;

use App\Services\Payments\{PaymentInterface, PaymentService};
use App\Services\PaymentMethods\{PaymentMethodInterface, PaymentMethodService};
use App\Services\Bookings\{BookingInterface, BookingService};
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
        $this->app->bind(PaymentInterface::class, PaymentService::class);
        $this->app->bind(PaymentMethodInterface::class, PaymentMethodService::class);
        $this->app->bind(BookingInterface::class, BookingService::class);
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
