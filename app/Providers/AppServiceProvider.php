<?php

namespace App\Providers;

use App\Services\Roles\{RoleInterface, RoleService};
use App\Services\PaymentMethods\{PaymentMethodInterface, PaymentMethodService};
use App\Services\InternationalIds\{InternationalIdInterface, InternationalIdService};
use App\Services\CabinTypes\{CabinTypeInterface, CabinTypeService};
use App\Services\CabinAssets\{CabinAssetInterface, CabinAssetService};
use App\Services\Cabins\{CabinInterface, CabinService};
use App\Services\BookingSources\{BookingSourceInterface, BookingSourceService};
use App\Services\Customers\{CustomerInterface, CustomerService};
use App\Services\Bookings\{BookingInterface, BookingService};
use App\Services\Payments\{PaymentInterface, PaymentService};
use App\Services\CustomerRatings\{CustomerRatingInterface, CustomerRatingService};

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
        $this->app->bind(PaymentMethodInterface::class, PaymentMethodService::class);
        $this->app->bind(InternationalIdInterface::class, InternationalIdService::class);
        $this->app->bind(CabinAssetInterface::class, CabinAssetService::class);
        $this->app->bind(CabinTypeInterface::class, CabinTypeService::class);
        $this->app->bind(CabinInterface::class, CabinService::class);
        $this->app->bind(BookingSourceInterface::class, BookingSourceService::class);
        $this->app->bind(CustomerInterface::class, CustomerService::class);
        $this->app->bind(BookingInterface::class, BookingService::class);
        $this->app->bind(PaymentInterface::class, PaymentService::class);

        $this->app->bind(CustomerRatingInterface::class, CustomerRatingService::class);
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
