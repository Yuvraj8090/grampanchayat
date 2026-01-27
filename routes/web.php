<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\PanchayatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StateController;

// Models
use App\Models\District;
use App\Models\Block;
use App\Models\Panchayat;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // ---------------------------------------------------------------------
    // Dashboard Route
    // ---------------------------------------------------------------------
    Route::get('/dashboard', function () {
        return view('dashboard', [
            // Counts for the stats cards
            'totalDistricts'   => District::count(),
            'totalBlocks'      => Block::count(),
            'totalPanchayats'  => Panchayat::count(),
            'totalUsers'       => User::count(),
            
            // Recent Data for the activity table (Eager loaded for performance)
            'recentPanchayats' => Panchayat::with('block')
                                    ->latest()
                                    ->take(5)
                                    ->get()
        ]);
    })->name('dashboard');

    // ---------------------------------------------------------------------
    // Admin Management Routes
    // ---------------------------------------------------------------------
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // User Management
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('states', StateController::class)->except(['show']);
        
        // Role Management
        Route::resource('roles', RoleController::class)->except(['show']);

        // Geographic Management
        Route::resource('districts', DistrictController::class)->except(['show']);
        Route::resource('blocks', BlockController::class)->except(['show']);
        
        // Panchayat Management 
        // Note: We removed except(['show']) here because your 'View' modal needs this route
        Route::resource('panchayats', PanchayatController::class);
    });

});