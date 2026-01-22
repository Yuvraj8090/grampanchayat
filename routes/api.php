<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;


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

Route::get('test',function(){
    return response()->json(['message'=>'test']);
});


Route::post('login', 'Apis\AuthController@login');
Route::post('/password/emails/reset', 'Auth\ForgotPasswordController@sendResetLinkEmailCustom');
Route::post('/feedback','Apis\UserController@feeback');

Route::middleware(['verifyUser'])->prefix('user')->group(function() {
    Route::post('profile/edit', 'Apis\AuthController@profileEdit');
    Route::post('change/password','Apis\AuthController@changePassword');
    Route::post('logout', 'Apis\AuthController@logout');
    Route::post('gram-panchayat-complaint','Apis\UserController@complaint');
    
});

Route::group(['namespace' => 'Apis'], function () {
    
    Route::get('index/{slug}', 'UserController@index');
    
    Route::get('pradhan-message/{slug}', 'UserController@message');
    
    Route::get('brave/{slug}', 'UserController@brave');

    Route::get('tourist-place/{slug}', 'UserController@place');
    
    Route::get('gallery/{slug}', 'UserController@gallery');
    
    Route::get('video/{slug}', 'UserController@video');
    
    Route::get('panchyat-business/{slug}', 'UserController@business');
    
    Route::get('gram-panchayat-leaders/{slug}', 'UserController@lead');
    
    Route::get('contact-us/{slug}', 'UserController@contact');
    
    Route::get('usernames', 'UserController@getAllUserNames');
    
    Route::get('states', 'UserController@getAllStates');
    
    Route::get('districts/{id}', 'UserController@getStateDistrict');
    
    Route::get('blocks/{id}', 'UserController@getDistictBlock');
    
    Route::get('gram-panchayat-development-works/{slug}', 'UserController@work');
     
    Route::get('important-information/{slug}', 'UserController@importantInformation');
    
    Route::post('user/create', 'AuthController@register');
    
    Route::get('govt/{slug}', 'UserController@govt');


});





