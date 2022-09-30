<?php

use App\Http\Controllers\TestController;
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

// First API Solution
Route::group(['prefix' => "assignment1"], function () {
    Route::get("/API1/{string?}", [TestController::class, 'firstAPI']);
});

// Second API Solution
Route::group(['prefix' => "assignment2"], function () {
    Route::get("/API2/{num?}", [TestController::class, 'secondAPI']);
});

// Third API Solution
Route::group(['prefix' => "assignment3"], function () {
    Route::get("/API3/{string?}", [TestController::class, 'thirdAPI']);
});

// Third API Test
Route::group(['prefix' => "assignment3t"], function () {
    Route::get("/API3t/{string?}", [TestController::class, 'thirdAPItest']);
});

// Fourth of july
Route::group(['prefix' => "assignment4"], function () {
    Route::get("/API4/{string?}", [TestController::class, 'fourthAPI']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
