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
    //AuthCycle
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::post('reset-password','AuthController@resetPassword');
    Route::post('new-password','AuthController@Password');
    //General Api
    Route::get('governorates','MainController@governorates');
    Route::get('cities','MainController@cities');
    Route::get('settings','MainController@settings');
    Route::post('contact','MainController@contact');
    Route::get('categories','MainController@categories');
    Route::get('blood-types','MainController@bloodTypes');

    //middleware auth
    Route::group(['middleware' => 'auth:api'],function(){
        Route::get('posts','MainController@posts');
        Route::put('profile','AuthController@profile');
        Route::post('toggle-favourites','AuthController@togglePostFavourites');
        Route::get('favourite-posts','MainController@favouritesPosts');
        Route::post('donation-request','MainController@donationRequestCreate');
    });
});
