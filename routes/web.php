<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\Customer\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});

Route::group(['prefix'=>'system'], function(){
    Auth::routes();
});


Route::get('/login', [CustomerLoginController::class, 'showLoginForm'])->name('c_login.get');
Route::post('/login', [CustomerLoginController::class, 'login'])->name('c_login.post');


Route::group(['middleware'=>'auth'], function(){
    Route::get('home', HomeController::class);
});



Route::group(['middleware'=>['auth:customer']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');
    Route::post('/logout', [CustomerLoginController::class, 'logout'])->name('c_logout');
    Route::group(['prefix'=>'api'], function(){
        Route::post('purchase-item', [PurchaseController::class, 'purchaseItem']);
        Route::get('/get-orders', [DashboardController::class, 'getOrders']);
        Route::post('/cancel-order', [DashboardController::class, 'cancelOrder']);
    });
});