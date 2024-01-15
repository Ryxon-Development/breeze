<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Coupon;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Test API
Route::get('/hello', function () {
    return response()->json([
        'message' => 'Hello World!',
    ], 200);
});

//---CUSTOM---
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
        ], 200);
    });

    Route::get('/auth', function(){
        return response()->json([
            'message' => 'Successfully authenticated!',
        ], 200);
    });
});

//---COUPONS---
Route::middleware('auth:sanctum')->group(function () {

    // INDEX
    Route::get('/coupons', [CouponController::class, 'index'])
        ->name('coupons.index')
        ->middleware('can:view-any-coupon');

    // STORE
    Route::post('/coupon', [CouponController::class, 'store'])
        ->name('coupons.store')
        ->middleware('can:create-coupon');

    // SHOW
    Route::get('/coupon/{coupon:code}', [CouponController::class, 'show'])
        ->name('coupons.show');

    // UPDATE
    Route::put('/coupon/{coupon:code}', [CouponController::class, 'update'])
        ->name('coupons.update')
        ->middleware('can:update-coupon');

    // ACTIVATE
    Route::put('/coupon/{coupon:code}/activate', [CouponController::class, 'activate'])
        ->name('coupons.activate')
        ->middleware('can:activate-coupon'); // Assuming activation is part of the update policy
});

