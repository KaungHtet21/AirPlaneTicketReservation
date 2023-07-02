<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\afterTransactionController;

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
Route::get('getFlights', [RouteController::class,'getFlights']);
Route::get('getMembers', [RouteController::class,'getMembers']);
Route::get('getSeats', [RouteController::class,'getSeats']);
Route::get('getUsers', [RouteController::class,'getUsers']);
Route::post('register',[RouteController::class,'register']);
Route::post('getEmailCode', [RouteController::class,'getEmailCode']);
Route::post('postPassengersInfo', [transactionController::class,'postPassengersInfo']);
Route::get('getVisas', [RouteController::class,'getVisas']);
Route::get('getMasters', [RouteController::class,'getMasters']);
//Route::post('postPassengersInfo', [transactionController::class,'postPassengersInfo']);
