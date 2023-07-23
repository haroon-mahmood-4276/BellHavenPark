<?php

use App\Http\Controllers\Ajax\CustomerController;
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
});
