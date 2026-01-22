<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin Routes Group
    Route::prefix('admin')->name('admin.')->group(function () {


        Route::resource('users', UserController::class)->only(['show']);
        Route::resource('roles', RoleController::class)->only(['show']);
    });
});
