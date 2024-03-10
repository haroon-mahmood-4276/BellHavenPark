<?php

use App\Http\Controllers\Ajax\{
    CabinController,
    CustomerController,
    MeterReadingController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['middleware' => 'auth', 'as' => 'ajax.'], function () {
Route::group(['as' => 'ajax.'], function () {
    // Customers Routes
    Route::prefix('customers')->name('customers.')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('index');

        Route::group(['prefix' => '/{customer}'], function () {
            Route::get('comments/modal', 'commentModalIndex')->name('modal.index');
            Route::post('comments/modal', 'commentModalStore')->name('modal.store');
        });
    });

    Route::prefix('cabins')->name('cabins.')->controller(CabinController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('modal-add-to-maintenance', 'modalAddToMaintenance')->name('modal.maintenance.add');
        Route::get('modal-remove-from-maintenance', 'modalRemoveFromMaintenance')->name('modal.maintenance.remove');

        Route::get('modal-add-to-needs-cleaning', 'modalAddToNeedsCleaning')->name('modal.needs-cleaning.add');
        Route::get('modal-remove-from-needs-cleaning', 'modalRemoveFromNeedsCleaning')->name('modal.needs-cleaning.remove');

        Route::prefix('{cabin}')->group(function () {
            Route::prefix('meter-readings')->name('meter-readings.')->controller(MeterReadingController::class)->group(function () {
                Route::get('previous', 'getPreviousReading')->name('previous');
            });
        });
    });
});
