<?php

use App\User;
use App\ListName;
use App\{ImporantTitle};
use App\Brave;
use App\JanPartinidhi;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

use App\Http\Controllers\AdminUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainIndex;

use App\Http\Controllers\AdminImportantController;
use App\Http\Controllers\AdminPartinidhiController;
use App\Http\Controllers\AdminJanController;
use App\Http\Controllers\Test;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserIndex;
use App\Http\Controllers\UserMedia;
use App\Http\Controllers\UserGallery;
use App\Http\Controllers\UserIntro;
use App\Http\Controllers\UserFact;
use App\Http\Controllers\UserPmsg;
use App\Http\Controllers\UserVideo;
use App\Http\Controllers\UserWork;
use App\Http\Controllers\UserAddress;
use App\Http\Controllers\UserLocation;
use App\Http\Controllers\UserList;
use App\Http\Controllers\UserEmail;
use App\Http\Controllers\UserPlaces;
use App\Http\Controllers\UserPlacesIntro;
use App\Http\Controllers\UserBusiness;
use App\Http\Controllers\UserBusinessIntro;
use App\Http\Controllers\UserRegister;
use App\Http\Controllers\BraveController;
use App\Http\Controllers\GovtController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\Admin;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/password/resets', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.requests');
Route::post('/password/emails/reset', 'Auth\ForgotPasswordController@sendResetLinkEmailCustom')->name('password.emails.reset');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset/password', 'Auth\ResetPasswordController@resetCustom')->name('password.update.request');

Route::post('/excel-upload','AdminUser@upload');

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home.index');
        

Route::get('contact-us', function() {
    return view('page.contact');
});

Route::get('privacy-policy', function() {
    return view('page.privacy');
});

    Route::get('/disticts', 'MainIndex@getDistrictByState');
    Route::get('/blocks', 'MainIndex@getBlockByDistrict');


Route::group(array('domain' => '{slug}.grampanchayat.org'), function (){
    Route::get('/', 'MainIndex@show');
    Route::get('/admin', 'MainIndex@create');
    Route::get('/pradhan-message', 'MainIndex@message');
    Route::get('/tourist-place', 'MainIndex@place');
    Route::get('/gallery', 'MainIndex@gallery');
    Route::get('/video', 'MainIndex@video');
    Route::get('/panchyat-business', 'MainIndex@business');
    Route::get('/gram-panchayat-leaders', 'MainIndex@lead');
    Route::get('/contact-us', 'MainIndex@contact');
    Route::get('/gram-panchayat-development-works', 'MainIndex@work');
    Route::get('/registers', 'MainIndex@re');
    
    Route::post('/resgister/store', 'MainIndex@store');
    

    Route::get('/important-information', function($slug){
        $user = User::whereSlug($slug)->firstOrFail();
        $name = ListName::where('user_id', '=', $user->id)->where('position', '=', 'प्रधान')->first();
        $data = ImporantTitle::with('posts')->get();
        return view('user.important', compact('user', 'name','data'));
    });
    
    Route::get('/disticts', 'MainIndex@getDistrictByState');
    Route::get('/blocks', 'MainIndex@getBlockByDistrict');

    
    Route::get('/testingdata', 'HomeController@index')->name('home');
    Route::get('/api/panch-bussiness', 'Test@business');
    Route::get('/api/prad-msg', 'Test@msg');
    Route::get('/api/photos', 'Test@photos');
    Route::get('/api/createDomain', 'Test@createDomain');
    Route::get('/api/deleteDomain', 'Test@deleteDomain');

});



Route::middleware(Admin::class)->group(function () {

    // --- Admin Dashboard ---
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    // --- Important Module ---
    // Custom routes must come BEFORE resource routes
    Route::get('important/delete/{id}', [AdminImportantController::class, 'delete'])->name('important.delete');
    Route::resource('important', AdminImportantController::class);

    // --- Points (Partinidhi) Module ---
    Route::controller(AdminPartinidhiController::class)->prefix('points')->name('points.')->group(function () {
        Route::get('delete/{id}', 'delete')->name('delete');
        Route::get('edit/{id}', 'edit')->name('edit_custom'); // Renamed to avoid conflict with resource 'edit'
        Route::get('index/{id}', 'index')->name('index_custom');
    });
    // Note: If you use the controller group above, you might not need this resource line if the methods clash.
    // If you need the standard CRUD as well:
    Route::resource('points', AdminPartinidhiController::class);

    // --- Jan Partinidhi Module ---
    Route::controller(AdminJanController::class)->prefix('jan-partinidhi')->name('jan-partinidhi.')->group(function () {
        Route::get('excelUpload', 'excelupload')->name('excel.create');
        Route::post('excel/upload', 'store1')->name('excel.store');
        Route::get('delete/{id}', 'delete')->name('delete');
        Route::post('update/{id}', 'update1')->name('update_custom');
    });
    Route::resource('jan-partinidhi', AdminJanController::class);

    // --- Bravee Module ---
    Route::controller(BraveController::class)->prefix('bravee')->name('bravee.')->group(function () {
        Route::post('update/{id}', 'update1')->name('update_custom');
        Route::get('delete/{id}', 'delete')->name('delete');
    });
    Route::resource('bravee', BraveController::class);

    // --- Settings & Profile ---
    Route::controller(AdminUser::class)->group(function () {
        Route::get('/setting', 'settingView')->name('admin.setting');
        Route::post('/change/password', 'changePassword')->name('admin.change-password');
        
        // Panchayat Excel
        Route::get('/panchayat/excel', 'excel')->name('panchayat.excel.view');
        Route::post('/panchayat/excel', 'excelUpload')->name('panchayat.excel.store');

        // Feedback
        // Fixed typo 'feebacks' to 'feedbacks'
        Route::get('/feedbacks', 'feeback')->name('feedbacks.index'); 
        Route::get('/feedbacks/delete/{id}', 'deletefeedback')->name('feedbacks.delete');
    });

    // --- Admin User Resource ---
    Route::resource('admin-user', AdminUser::class);

});
Route::group(['middleware' => \App\Http\Middleware\User::class], function(){
    
    Route::resource('/govtfacility', GovtController::class);
     Route::get('/govtfacility/delete/{id}', [GovtController::class,'delete']);
    Route::post('/govtfacility/update/{id}', [GovtController::class,'update1']);

	Route::resource('/dashboard', UserIndex::class);

    Route::resource('/user-media', UserMedia::class);

    Route::resource('/user-gallery', UserGallery::class);

    Route::resource('/user-introduction', UserIntro::class);

    Route::resource('/user-facts', UserFact::class);

    Route::resource('/user-p-message', UserPmsg::class);

    Route::resource('/user-video', UserVideo::class);

    Route::resource('/user-work', UserWork::class);

    Route::resource('/user-address', UserAddress::class);

    Route::resource('/user-location', UserLocation::class);

    Route::resource('/user-list', UserList::class);

    Route::resource('/user-email', UserEmail::class);
    
    Route::resource('/user-places', UserPlaces::class);

    Route::resource('/user-places-intro', UserPlacesIntro::class);

    Route::resource('/user-business', UserBusiness::class);

    Route::resource('/user-business-intro', UserBusinessIntro::class);

    Route::resource('/user-register', UserRegister::class);
    


});

Route::get('/', function () {
    return view('welcome');
});





