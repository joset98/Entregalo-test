<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\DeliveryRequestController;
use App\Http\Controllers\DeliveryController;
// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    //delivery-requests
    Route::get('/delivery-requests',[DeliveryRequestController::class, 'index'] );
    Route::get('/delivery-request/show',[DeliveryRequestController::class, 'show'] );
    Route::get('/delivery-request/create',[DeliveryRequestController::class, 'create'] );
    Route::get('/delivery-request/edit',[DeliveryRequestController::class, 'edit'] );
    Route::post('/delivery-request',[DeliveryRequestController::class, 'store'] );
    Route::put('/delivery-request/{delivery-request}',[DeliveryRequestController::class, 'update'] );
    Route::delete('/delivery-request/{delivery-request}',[DeliveryRequestController::class, 'delete'] );

    //deliveries
    Route::get('/deliveries',[DeliveryController::class, 'index'] );
    Route::get('/delivery/show',[DeliveryController::class, 'show'] );

    //supplies
    Route::get('/supply',[DeliveryController::class, 'index'] );

    //admin routes
    Route::prefix('admin')->middleware(['role:ADMIN'])->group(function () {

        Route::resource('supply', SupplyController::class);

        Route::resource('delivery', DeliveryController::class);

        Route::resource('delivery-request', DeliveryRequestController::class);
    });
});



Route::middleware([])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
