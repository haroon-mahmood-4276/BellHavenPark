<?php

use App\Http\Controllers\{
    BookingController,
    BookingSourceController,
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
    Route::group(['prefix' => 'international-ids', 'as' => 'international-ids.'], function () {
        Route::get('/', [InternationalIdController::class, 'index'])->middleware('permission:international-ids.index')->name('index');

        Route::group(['middleware' => 'permission:international-ids.create'], function () {
            Route::get('create', [InternationalIdController::class, 'create'])->name('create');
            Route::post('store', [InternationalIdController::class, 'store'])->name('store');
        });

        Route::get('delete', [InternationalIdController::class, 'destroy'])->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:international-ids.edit'], function () {
            Route::get('edit', [InternationalIdController::class, 'edit'])->name('edit');
            Route::put('update', [InternationalIdController::class, 'update'])->name('update');
        });
    });

    // Cabin Types Routes
    Route::group(['prefix' => 'cabin-types', 'as' => 'cabin-types.'], function () {
        Route::get('/', [CabinTypeController::class, 'index'])->middleware('permission:cabin-types.index')->name('index');

        Route::group(['middleware' => 'permission:cabin-types.create'], function () {
            Route::get('create', [CabinTypeController::class, 'create'])->name('create');
            Route::post('store', [CabinTypeController::class, 'store'])->name('store');
        });

        Route::get('delete', [CabinTypeController::class, 'destroy'])->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:cabin-types.edit'], function () {
            Route::get('edit', [CabinTypeController::class, 'edit'])->name('edit');
            Route::put('update', [CabinTypeController::class, 'update'])->name('update');
        });
    });

    // Cabin Routes
    Route::group(['prefix' => 'cabins', 'as' => 'cabins.'], function () {
        Route::get('/', [CabinController::class, 'index'])->middleware('permission:cabins.index')->name('index');

        Route::group(['middleware' => 'permission:cabins.create'], function () {
            Route::get('create', [CabinController::class, 'create'])->name('create');
            Route::post('store', [CabinController::class, 'store'])->name('store');
        });

        Route::get('delete', [CabinController::class, 'destroy'])->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:cabins.edit'], function () {
            Route::get('edit', [CabinController::class, 'edit'])->name('edit');
            Route::put('update', [CabinController::class, 'update'])->name('update');
        });
    });

    // Booking Sources Routes
    Route::group(['prefix' => 'booking-sources', 'as' => 'booking-sources.'], function () {
        Route::get('/', [BookingSourceController::class, 'index'])->middleware('permission:booking-sources.index')->name('index');

        Route::group(['middleware' => 'permission:booking-sources.create'], function () {
            Route::get('create', [BookingSourceController::class, 'create'])->name('create');
            Route::post('store', [BookingSourceController::class, 'store'])->name('store');
        });

        Route::get('delete', [BookingSourceController::class, 'destroy'])->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:booking-sources.edit'], function () {
            Route::get('edit', [BookingSourceController::class, 'edit'])->name('edit');
            Route::put('update', [BookingSourceController::class, 'update'])->name('update');
        });
    });

    // Customers Routes
    Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
        Route::get('/', [CustomerController::class, 'index'])->middleware('permission:customers.index')->name('index');

        Route::group(['middleware' => 'permission:customers.create'], function () {
            Route::get('create', [CustomerController::class, 'create'])->name('create');
            Route::post('store', [CustomerController::class, 'store'])->name('store');
        });

        Route::get('delete', [CustomerController::class, 'destroy'])->name('destroy');

        Route::group(['prefix' => '/{id}', 'middleware' => 'permission:customers.edit'], function () {
            Route::get('edit', [CustomerController::class, 'edit'])->name('edit');
            Route::put('update', [CustomerController::class, 'update'])->name('update');
        });
    });

    // Booking Routes
    Route::as('bookings.')->prefix('bookings')->controller(BookingController::class)->group(function () {

        Route::get('/', 'index')->middleware('permission:bookings.index')->name('index');

        Route::group(['middleware' => 'permission:customers.edit'], function () {
            Route::get('/create', 'create')->name('create');
            Route::get('/create/modal', 'createModal')->name('create.modal');
        });

        Route::post('/store', 'store')->name('store');

        Route::get('/check-in', 'checkInIndex')->name('checkin.index');
        Route::get('/check-out', 'checkOutIndex')->name('checkout.index');

        Route::group(['prefix' => '/{id}'], function () {
            Route::post('/check-in', 'checkInStore')->name('checkin.store');

            Route::post('/check-out', 'checkOutStore')->name('checkout.store');
        });

        Route::as('payments.')->prefix('/{id}')->controller(PaymentController::class)->group(function () {
            Route::get('/payments', 'index')->name('index');

            Route::get('/payments/create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });


        // Route::get('/calender', [BookingsController::class, 'calenderView'])->name('calenderView');

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
