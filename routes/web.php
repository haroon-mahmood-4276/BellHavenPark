<?php

use App\Http\Controllers\{
    BookingsController,
    BookingSourceController,
    CabinController,
    CabinTypeController,
    CabinStatusController,
    SettingController,
    DashboardController,
    InternationalIdController,
    CustomerController,
    PaymentController,
    PaymentMethodController,
    RoleController,
};
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('pages/{page_name}', function ($page_name) {
    return view($page_name);
});

Route::get('', function () {
    return redirect()->route('auth.login.view');
});

require __DIR__ . "/auth.php";

Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('cache/flush', function () {
        cache()->flush();
        return redirect()->back()->withSuccess('Site cache refreshed.');
    })->name('cache.flush');

    // Roles Routes
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}/show', [RoleController::class, 'show'])->name('show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });

    // Permission Routes
    Route::group(['prefix' => 'roles/{role}/permissions', 'as' => 'roles.'], function () {
        Route::get('/', [RoleController::class, 'permissions'])->name('permissions');
        Route::put('update', [RoleController::class, 'updatePermissions'])->name('permissions.update');
    });

    // International IDs Routes
    Route::group(['prefix' => 'international-ids', 'as' => 'internationalids.'], function () {
        Route::get('/', [InternationalIdController::class, 'index'])->name('index');
        Route::get('/create', [InternationalIdController::class, 'create'])->name('create');
        Route::post('/', [InternationalIdController::class, 'store'])->name('store');
        Route::get('/{internationalid}/show', [InternationalIdController::class, 'show'])->name('show');
        Route::get('/{internationalid}/edit', [InternationalIdController::class, 'edit'])->name('edit');
        Route::put('/{internationalid}', [InternationalIdController::class, 'update'])->name('update');
        Route::delete('/{internationalid}', [InternationalIdController::class, 'destroy'])->name('destroy');
    });

    // Customers Routes
    Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
        Route::get('/{customer}/show', [CustomerController::class, 'show'])->name('show');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
    });

    // Cabin Type Routes
    Route::group(['prefix' => 'cabin-types', 'as' => 'cabin_types.'], function () {
        Route::get('/', [CabinTypeController::class, 'index'])->name('index');
        Route::get('/create', [CabinTypeController::class, 'create'])->name('create');
        Route::post('/', [CabinTypeController::class, 'store'])->name('store');
        Route::get('/{cabin_type}/show', [CabinTypeController::class, 'show'])->name('show');
        Route::get('/{cabin_type}/edit', [CabinTypeController::class, 'edit'])->name('edit');
        Route::put('/{cabin_type}', [CabinTypeController::class, 'update'])->name('update');
        Route::delete('/{cabin_type}', [CabinTypeController::class, 'destroy'])->name('destroy');
    });

    // Cabin Status Routes
    Route::group(['prefix' => 'cabin-statuses', 'as' => 'cabin_statuses.'], function () {
        Route::get('/', [CabinStatusController::class, 'index'])->name('index');
        Route::get('/create', [CabinStatusController::class, 'create'])->name('create');
        Route::post('/', [CabinStatusController::class, 'store'])->name('store');
        Route::get('/{cabin_status}/show', [CabinStatusController::class, 'show'])->name('show');
        Route::get('/{cabin_status}/edit', [CabinStatusController::class, 'edit'])->name('edit');
        Route::put('/{cabin_status}', [CabinStatusController::class, 'update'])->name('update');
        Route::delete('/{cabin_status}', [CabinStatusController::class, 'destroy'])->name('destroy');
    });

    // Cabin Routes
    Route::group(['prefix' => 'cabins', 'as' => 'cabins.'], function () {
        Route::get('/', [CabinController::class, 'index'])->name('index');
        Route::get('/create', [CabinController::class, 'create'])->name('create');
        Route::post('/', [CabinController::class, 'store'])->name('store');
        Route::get('/{cabin}/show', [CabinController::class, 'show'])->name('show');
        Route::get('/{cabin}/edit', [CabinController::class, 'edit'])->name('edit');
        Route::put('/{cabin}', [CabinController::class, 'update'])->name('update');
        Route::delete('/{cabin}', [CabinController::class, 'destroy'])->name('destroy');
    });

    // BookingSource Routes
    Route::group(['prefix' => 'booking-sources', 'as' => 'booking_sources.'], function () {
        Route::get('/', [BookingSourceController::class, 'index'])->name('index');
        Route::get('/create', [BookingSourceController::class, 'create'])->name('create');
        Route::post('/', [BookingSourceController::class, 'store'])->name('store');
        Route::get('/{booking_source}/show', [BookingSourceController::class, 'show'])->name('show');
        Route::get('/{booking_source}/edit', [BookingSourceController::class, 'edit'])->name('edit');
        Route::put('/{booking_source}', [BookingSourceController::class, 'update'])->name('update');
        Route::delete('/{booking_source}', [BookingSourceController::class, 'destroy'])->name('destroy');
    });

    // Booking Routes
    Route::group(['prefix' => 'bookings', 'as' => 'bookings.'], function () {

        Route::get('/', [BookingsController::class, 'index'])->name('index');

        Route::get('cabins', [BookingsController::class, 'cabinsList'])->name('cabins');

        Route::get('/create', [BookingsController::class, 'create'])->name('create');
        Route::get('/create/{cabin_id}/modal', [BookingsController::class, 'createModal'])->name('create.modal');

        Route::post('/', [BookingsController::class, 'store'])->name('store');

        Route::get('/calender', [BookingsController::class, 'calenderView'])->name('calenderView');

        Route::get('/{booking}/show', [BookingsController::class, 'show'])->name('show');

        Route::get('/{booking}/edit', [BookingsController::class, 'edit'])->name('edit');
        Route::put('/{booking}', [BookingsController::class, 'update'])->name('update');

        Route::delete('/{booking}', [BookingsController::class, 'destroy'])->name('destroy');

        Route::get('/check-in', [BookingsController::class, 'CheckInIndex'])->name('checkin.index');
        Route::get('/check-in/{booking}', [BookingsController::class, 'CheckInStore'])->name('checkin.store');

        Route::get('/check-out', [BookingsController::class, 'CheckOutIndex'])->name('checkout.index');
        Route::get('/check-out/{booking}', [BookingsController::class, 'CheckOutStore'])->name('checkout.store');


        // Payments Routes
        Route::group(['prefix' => '/{booking}', 'as' => 'payments.'], function () {
            Route::get('/payments', [PaymentController::class, 'index'])->name('index');
            Route::get('/payments/create', [PaymentController::class, 'create'])->name('create');
        });
    });

    // BookingSource Routes
    Route::group(['prefix' => 'payment-methods', 'as' => 'payment_methods.'], function () {
        Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
        Route::get('/create', [PaymentMethodController::class, 'create'])->name('create');
        Route::post('/store', [PaymentMethodController::class, 'store'])->name('store');

        Route::get('delete', [PaymentMethodController::class, 'destroy'])->name('destroy');
        Route::group(['prefix' => '/{id}'], function () {
            Route::get('edit', [PaymentMethodController::class, 'edit'])->name('edit');
            Route::put('update', [PaymentMethodController::class, 'update'])->name('update');
        });
    });

    // Settings Routes
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('/update', [SettingController::class, 'update'])->name('update');
    });
});
