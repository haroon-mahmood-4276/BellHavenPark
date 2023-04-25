<?php
use App\Http\Controllers\{
	AuthController,
};
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'auth.', 'middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'LoginView'])->name('login.view');
    Route::post('login', [AuthController::class, 'Login'])->name('login');
});
Route::group(['as' => 'auth.', 'middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'Logout'])->name('logout');
});
