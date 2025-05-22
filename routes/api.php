<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
   
//     Route::get('user', function (Request $request) {
//         return $request->user();
//     });
    
//     Route::post('logout', [AuthController::class, 'logout']);
    
//     Route::get('customers', [CustomerController::class, 'index']);
//     Route::post('customers', [CustomerController::class, 'store']);
    
//     Route::get('invoices', [InvoiceController::class, 'index']);
//     Route::post('invoices', [InvoiceController::class, 'store']);
    
// });


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('dashboard-data', [DashboardController::class, 'index']);
    Route::post('dashboard-data', [DashboardController::class, 'store']);

});