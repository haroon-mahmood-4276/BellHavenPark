<?php

use App\Http\Controllers\{
    BookingController,
    BookingSourceController,
    BookingTaxController,
    CabinController,
    CabinTypeController,
    CustomerController,
    DashboardController,
    InternationalIdController,
    PaymentController,
    PaymentMethodController,
    PermissionController,
    RoleController,
    SettingController,
};
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', [DashboardController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('cache/flush', function () {
        cache()->flush();
        return redirect()->back()->withSuccess('Site cache refreshed.');
    })->name('cache.flush');


    //Role Routes
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/', [RoleController::class, 'index'])->middleware('permission:roles.index')->name('index');

        Route::group(['middleware' => 'permission:roles.create'], function () {
            Route::get('create', [RoleController::class, 'create'])->name('create');
            Route::post('store', [RoleController::class, 'store'])->name('store');
        });

        Route::get('delete', [RoleController::class, 'destroy'])->middleware('permission:roles.destroy')->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:roles.edit'], function () {
            Route::get('edit', [RoleController::class, 'edit'])->name('edit');
            Route::put('update', [RoleController::class, 'update'])->name('update');
        });
    });

    //Permissions Routes
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::get('/', [PermissionController::class, 'index'])->middleware('permission:permissions.index')->name('index');

        Route::post('assign-permission', [PermissionController::class, 'assignPermissionToRole'])->middleware('permission:permissions.assign-permission')->name('assign-permission');
        Route::post('revoke-permission', [PermissionController::class, 'revokePermissionToRole'])->middleware('permission:permissions.revoke-permission')->name('revoke-permission');
    });

    // Payment Methods Routes
    Route::group(['prefix' => 'payment-methods', 'as' => 'payment-methods.'], function () {
        Route::get('/', [PaymentMethodController::class, 'index'])->middleware('permission:payment-methods.index')->name('index');

        Route::group(['middleware' => 'permission:payment-methods.create'], function () {
            Route::get('create', [PaymentMethodController::class, 'create'])->name('create');
            Route::post('store', [PaymentMethodController::class, 'store'])->name('store');
        });

        Route::get('delete', [PaymentMethodController::class, 'destroy'])->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:payment-methods.edit'], function () {
            Route::get('edit', [PaymentMethodController::class, 'edit'])->name('edit');
            Route::put('update', [PaymentMethodController::class, 'update'])->name('update');
        });
    });

    // International Ids Routes
    Route::prefix('international-ids')->name('international-ids.')->controller(InternationalIdController::class)->group(function () {
        Route::get('/', 'index')->middleware('permission:international-ids.index')->name('index');

        Route::group(['middleware' => 'permission:international-ids.create'], function () {
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });

        Route::get('delete', 'destroy')->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:international-ids.edit'], function () {
            Route::get('edit', 'edit')->name('edit');
            Route::put('update', 'update')->name('update');
        });
    });

    // Cabin Types Routes
    Route::prefix('cabin-types')->name('cabin-types.')->controller(CabinTypeController::class)->group(function () {
        Route::get('/', 'index')->middleware('permission:cabin-types.index')->name('index');

        Route::group(['middleware' => 'permission:cabin-types.create'], function () {
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });

        Route::get('delete', 'destroy')->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:cabin-types.edit'], function () {
            Route::get('edit', 'edit')->name('edit');
            Route::put('update', 'update')->name('update');
        });
    });

    // Cabin Routes
    Route::prefix('cabins')->name('cabins.')->controller(CabinController::class)->group(function () {
        Route::get('/', 'index')->middleware('permission:cabins.index')->name('index');

        Route::group(['middleware' => 'permission:cabins.create'], function () {
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });

        Route::get('delete', 'destroy')->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:cabins.edit'], function () {
            Route::get('edit', 'edit')->name('edit');
            Route::put('update', 'update')->name('update');
        });
    });

    // Booking Sources Routes
    Route::prefix('booking-sources')->name('booking-sources.')->controller(BookingSourceController::class)->group(function () {
        Route::get('/', 'index')->middleware('permission:booking-sources.index')->name('index');

        Route::group(['middleware' => 'permission:booking-sources.create'], function () {
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });

        Route::get('delete', 'destroy')->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:booking-sources.edit'], function () {
            Route::get('edit', 'edit')->name('edit');
            Route::put('update', 'update')->name('update');
        });
    });

    // Booking Taxes Routes
    Route::prefix('booking-taxes')->name('booking-taxes.')->controller(BookingTaxController::class)->group(function () {
        Route::get('/', 'index')->middleware('permission:booking-taxes.index')->name('index');

        Route::group(['middleware' => 'permission:booking-taxes.create'], function () {
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });

        Route::get('delete', 'destroy')->name('destroy');

        Route::group(['prefix' => '/{booking_tax}', 'middleware' => 'permission:booking-taxes.edit'], function () {
            Route::get('edit', 'edit')->name('edit');
            Route::put('update', 'update')->name('update');
        });
    });

    // Customers Routes
    Route::prefix('customers')->name('customers.')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->middleware('permission:customers.index')->name('index');

        Route::group(['middleware' => 'permission:customers.create'], function () {
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });

        Route::get('delete', 'destroy')->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:customers.edit'], function () {
            Route::get('edit', 'edit')->name('edit');
            Route::put('update', 'update')->name('update');
        });
    });

    // Booking Routes
    Route::as('bookings.')->prefix('bookings')->controller(BookingController::class)->group(function () {

        Route::get('/', 'index')->middleware('permission:bookings.index')->name('index');

        Route::group(['middleware' => 'permission:bookings.create'], function () {
            Route::get('/create', 'create')->name('create');
            Route::get('/create/modal', 'createModal')->name('create.modal');
            Route::post('/store', 'store')->name('store');
        });

        Route::group(['middleware' => 'permission:bookings.checkin.index'], function () {
            Route::get('/check-in', 'checkInIndex')->name('checkin.index');
            Route::post('/{id}/check-in', 'checkInStore')->name('checkin.store');
        });

        Route::group(['middleware' => 'permission:bookings.checkout.index'], function () {
            Route::get('/check-out', 'checkOutIndex')->name('checkout.index');
            Route::post('/{id}/check-out', 'checkOutStore')->name('checkout.store');
        });


        Route::as('payments.')->prefix('/{id}')->controller(PaymentController::class)->group(function () {
            Route::get('/payments', 'index')->middleware('permission:bookings.payments.index')->name('index');

            Route::group(['middleware' => 'permission:bookings.payments.create'], function () {
                Route::get('/payments/create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
            });
        });

        Route::group(['middleware' => 'permission:bookings.calender.index', 'as' => 'calender.'], function () {
            Route::get('/calender', 'calenderView')->name('index');
        });


        // Route::get('/{booking}/show', [BookingsController::class, 'show'])->name('show');

        // Route::get('/{booking}/edit', [BookingsController::class, 'edit'])->name('edit');
        // Route::put('/{booking}', [BookingsController::class, 'update'])->name('update');

        // Route::delete('/{booking}', [BookingsController::class, 'destroy'])->name('destroy');

    });

    // Settings Routes
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('/update', [SettingController::class, 'update'])->name('update');
    });
});
