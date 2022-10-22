<?php

use App\Http\Controllers\Api\MainController;
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

//cause of folder Api that created in controllers used namespace api
Route::group(['prefix' => 'v1','namespace' => 'Api'],function(){
    Route::get('governorates','MainController@governorates');
    Route::get('cities','MainController@cities');
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::group(['middleware' => 'auth:api'],function(){
        Route::get('posts','MainController@posts');
        Route::post('contact','MainController@contact');
    });
});
