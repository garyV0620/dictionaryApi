<?php

use App\Http\Controllers\Api\Dictionary;
use App\Http\Controllers\MovieController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//added group if you want to group Routes with the same middleware
// Route::middleware('isValidToken')->group(function(){
//     Route::resource('dictionary', Dictionary::class);
// });

// you can use the middleware that you register, then resource for basic operations, only to inlcude what you use
Route::middleware('isValidToken')->resource('dictionary', Dictionary::class)->only(['index', 'show', 'store', 'update', 'destroy']);

Route::middleware('movieToken')->group( function(){
    Route::resource('movie', MovieController::class)->only(['index', 'store']);
});