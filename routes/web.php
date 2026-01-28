<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\PanchayatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\PanchayatPlaceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PanchayatBusinessController;
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
use App\Http\Controllers\PanchayatDetailController;
use App\Http\Controllers\PublicPanchayatController;

/*
|--------------------------------------------------------------------------
| Public Routes (No Login Required)
|--------------------------------------------------------------------------
| This allows anyone to visit: yoursite.com/panchayat/1
*/
Route::get('/{id}/panchayat', [PublicPanchayatController::class, 'show'])->name('public.panchayat.show');
Route::get('/{id}/pradhan-message', [PublicPanchayatController::class, 'pradhanMessage'])->name('public.pradhan_message.show');
Route::get('/{id}/tourist-places', [PublicPanchayatController::class, 'touristPlaces'])->name('public.tourist_places.show');
Route::get('/{id}/gallery', [PublicPanchayatController::class, 'gallery'])->name('public.gallery.images');
Route::get('/{id}/video', [PublicPanchayatController::class, 'video'])->name('public.gallery.videos');

/*
|--------------------------------------------------------------------------
| Admin Routes (Login Required)
|--------------------------------------------------------------------------
| These are for the Admin to edit the data.
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // ---------------------------------------------------------------------
    // Dashboard Route
    // ---------------------------------------------------------------------
    Route::get('/dashboard', function () {
        return view('dashboard', [
            // Counts for the stats cards
            'totalDistricts' => District::count(),
            'totalBlocks' => Block::count(),
            'totalPanchayats' => Panchayat::count(),
            'totalUsers' => User::count(),

            // Recent Data for the activity table (Eager loaded for performance)
            'recentPanchayats' => Panchayat::with('block')->latest()->take(5)->get(),
        ]);
    })->name('dashboard');

    // ---------------------------------------------------------------------
    // Admin Management Routes
    // ---------------------------------------------------------------------
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            

Route::prefix('panchayats/{panchayat}')->name('panchayats.')->group(function () {
    Route::resource('businesses', PanchayatBusinessController::class);
});
            Route::prefix('/panchayats')
                ->name('panchayats.')
                ->group(function () {
                    Route::resource('{panchayat}/places', PanchayatPlaceController::class);
                   Route::get('{panchayat}/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    
    // 2. Store (Upload)
    Route::post('{panchayat}/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    
    // 3. Edit (Show Form)
    Route::get('{panchayat}/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    
    // 4. Update (Save Changes)
    Route::put('{panchayat}/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    
    // 5. Destroy (Delete)
    Route::delete('gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
                });
            // User Management
            Route::get('/get-locations', [UserController::class, 'getLocations'])->name('get.locations');
            Route::resource('users', UserController::class)->except(['show']);
            Route::resource('states', StateController::class)->except(['show']);

            // Role Management
            Route::resource('roles', RoleController::class)->except(['show']);
            // Show the Edit Form
            Route::get('/panchayat/{id}/manage-website', [PanchayatDetailController::class, 'edit'])->name('panchayat.details.edit');

            // Save the Data
            Route::post('/panchayat/{id}/manage-website', [PanchayatDetailController::class, 'update'])->name('panchayat.details.update');
            // Geographic Management
            Route::resource('districts', DistrictController::class)->except(['show']);
            Route::resource('blocks', BlockController::class)->except(['show']);
            // Panchayat Management
            // Note: We removed except(['show']) here because your 'View' modal needs this route
            Route::resource('panchayats', PanchayatController::class);
        });
});
