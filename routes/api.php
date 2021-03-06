<?php

use App\Http\Controllers\Api\ImageController as ApiImageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('image',[ApiImageController::class, 'imageStore']);
Route::post('imageUpdate/{id}',[ApiImageController::class, 'imageUpdate']);
Route::get('images',[ApiImageController::class, 'images']);
Route::delete('imageDelete/{id}',[ApiImageController::class, 'delete']);