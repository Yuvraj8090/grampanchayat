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


Route::group(['middleware' => \App\Http\Middleware\Admin::class], function(){
    
    Route::get('important/delete/{id}', [AdminImportantController::class,'delete']);
    Route::resource('/important', AdminImportantController::class);
    Route::resource('/points', AdminPartinidhiController::class);

    Route::get('jan-partinidhi/excelUpload', 'AdminJanController@excelupload');
    Route::post('jan-partinidhi/excel/upload', 'AdminJanController@store1');

    Route::resource('/jan-partinidhi', 'AdminJanController');
    
    Route::resource('/bravee', 'BraveController');
    Route::post('/bravee/update/{id}', 'BraveController@update1');
    Route::get('/bravee/delete/{id}', 'BraveController@delete');



    Route::get('/jan-partinidhi/delete/{id}', 'AdminJanController@delete');
    Route::post('/jan-partinidhi/update/{id}', 'AdminJanController@update1');

    Route::get('points/delete/{id}', 'AdminPartinidhiController@delete');
    
    Route::get('points/edit/{id}', 'AdminPartinidhiController@edit');
    
    Route::get('points/index/{id}', 'AdminPartinidhiController@index');
    
    Route::get('/setting','AdminUser@settingView');
    Route::post('/change/password','AdminUser@changePassword');

    Route::get('/panchayat/excel','AdminUser@excel');
    Route::post('/panchayat/excel','AdminUser@excelUpload');

    Route::get('/feebacks','AdminUser@feeback');
    
    Route::get('/deletefeedback/{id}','AdminUser@deletefeedback');

	Route::get('/admin', function(){
		return view('admin.index');
	});

    Route::resource('/admin-user',AdminUser::class);
});

Route::group(['middleware' => \App\Http\Middleware\User::class], function(){
    
    Route::resource('/govtfacility', 'GovtController');
     Route::get('/govtfacility/delete/{id}', 'GovtController@delete');
    Route::post('/govtfacility/update/{id}', 'GovtController@update1');

	Route::resource('/dashboard', UserIndex::class);

    Route::resource('/user-media', UserMedia::class);

    Route::resource('/user-gallery', UserGallery::class);

    Route::resource('/user-introduction', 'UserIntro');

    Route::resource('/user-facts', 'UserFact');

    Route::resource('/user-p-message', 'UserPmsg');

    Route::resource('/user-video', 'UserVideo');

    Route::resource('/user-work', 'UserWork');

    Route::resource('/user-address', 'UserAddress');

    Route::resource('/user-location', 'UserLocation');

    Route::resource('/user-list', 'UserList');

    Route::resource('/user-email', 'UserEmail');
    
    Route::resource('/user-places', 'UserPlaces');

    Route::resource('/user-places-intro', 'UserPlacesIntro');

    Route::resource('/user-business', 'UserBusiness');

    Route::resource('/user-business-intro', 'UserBusinessIntro');

    Route::resource('/user-register', 'UserRegister');
    


});

Route::get('/', function () {
    return view('welcome');
});





