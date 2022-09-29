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

/* Start */

Route::group(['prefix' => "v1"], function () {
    Route::group(['prefix' => "test"], function () {
        Route::group(['middleware' => "role.admin"], function () {
            Route::get("/users", [TestController::class, 'getUsers']);
        });

        Route::get("/hi/{name?}", [TestController::class, 'sayHi']);
        Route::post("/add_user", [TestController::class, 'addUser']);
    });

    Route::group(['prefix' => "assignment1"], function () {
        Route::get("/API1/{string?}", [TestController::class, 'firstAPI']);
    });

    Route::group(['prefix' => "assignment1"], function () {
        Route::get("/API1/{string?}", [TestController::class, 'firstAPI']);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
