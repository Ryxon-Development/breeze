<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Coupon;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/test', function(){
        $response = json_encode([
            'message' => 'Successfully authenticated!',
        ], 200);
        return response($response, 200)->header('Content-Type', 'application/json');
    });

    Route::get('/coupons/{coupon:code}', function(Coupon $coupon){
        return response()->json([
            'coupon' => $coupon,
        ], 200);
    });
    Route::get('/coupons', function(){
        $coupons = App\Models\Coupon::all();
        return response()->json([
            'coupons' => $coupons,
        ], 200);
    });
});

Route::middleware('auth')->group(function () {
   Route::put('/generate-token/{user}', [UserController::class, 'generateApiToken'])->name('generate-token');
});

Route::put('/generate-token/{user}', [UserController::class, 'generateApiToken'])->name('generate-token');

Route::get('/hello', function () {

    //get logged in user
    $user = User::find(1);
//    $token = $user->createToken('token-name')->plainTextToken;
    //generate api_token for user
    $token = $user->createToken('token-name')->plainTextToken;
    $user->api_token = $token;
    $user->save();

    return response()->json([
        'message' => 'Hello World!',
    ], 200);
});

