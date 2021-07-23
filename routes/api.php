<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::post('login', function (Request $request)
    {
        return $request->all();
    });

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'Auth\PassportController@logout');
        Route::get('user', 'Auth\PassportController@user');

        Route::apiResource('users','cms\UserController');
        Route::apiResource('consoles','cms\ConsoleController');
        // Route::apiResource('video-games','cms\VideoGameController');
        
    });

    
});