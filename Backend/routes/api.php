<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Models\Customer;

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

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/profile', [AuthController::class, 'userProfile']);  
    Route::resource('/products', ProductController::class);  
    Route::get('/customers', [CustomerController::class, 'index']);  
    Route::get('/customers/{id}', [CustomerController::class, 'showCustomer']);
    Route::post('/customers', [CustomerController::class, 'createCustomer']);  
    Route::get('/user/{id}/customers', [CustomerController::class, 'getUserCustomers']);
    Route::post('edit/customer/{id}', [CustomerController::class, 'editCustomerProfil']);
});