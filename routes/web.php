<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\AboutController;

Auth::routes();
require __DIR__ . '/auth.php';

// Public routes
Route::view('/', 'layout.client');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::view('profile', 'profile')->name('profile');

    Route::middleware('verified')->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

    // Review routes
    Route::get('/review-form/{bookingID}', [ReviewController::class, 'reviewForm'])->name('review-form');
    Route::post('/submit-review/{bookingID}', [ReviewController::class, 'submitReview'])->name('submit-review');
});

// Admin routes
Route::prefix('admin')->as('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Banner routes
        Route::prefix('banners')->as('banners.')->group(function () {
            Route::get('/', [BannerController::class, 'listBanner'])->name('listBanner');
            Route::get('/add', [BannerController::class, 'addBanner'])->name('addBanner');
            Route::post('/add', [BannerController::class, 'addPostBanner'])->name('addPostBanner');
            Route::get('/{idbanner}', [BannerController::class, 'detailBanner'])->name('detailBanner');
            Route::delete('/delete', [BannerController::class, 'deleteBanner'])->name('deleteBanner');
            Route::get('/{idBanner}/edit', [BannerController::class, 'updateBanner'])->name('updateBanner');
            Route::patch('/{idBanner}', [BannerController::class, 'updatePatchBanner'])->name('updatePatchBanner');
        });

        // Staff routes
        Route::prefix('staffs')->as('staffs.')->group(function () {
            Route::get('/', [StaffController::class, 'listStaff'])->name('listStaff');
            Route::get('/add', [StaffController::class, 'addStaff'])->name('addStaff');
            Route::post('/add', [StaffController::class, 'addPostStaff'])->name('addPostStaff');
            Route::get('/{idStaff}', [StaffController::class, 'detailStaff'])->name('detailStaff');
            Route::delete('/delete', [StaffController::class, 'deleteStaff'])->name('deleteStaff');
            Route::get('/{idStaff}/edit', [StaffController::class, 'updateStaff'])->name('updateStaff');
            Route::patch('/{idStaff}', [StaffController::class, 'updatePatchStaff'])->name('updatePatchStaff');
        });

        // Contact routes
        Route::prefix('contacts')->as('contacts.')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('index');
            Route::get('/{id}', [ContactController::class, 'show'])->name('show');
            Route::post('/{id}/status', [ContactController::class, 'updateStatus'])->name('updateStatus');
            Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
        });

        // Post Category routes
        Route::prefix('postcategory')->as('postcategory.')->group(function () {
            Route::get('/', [PostCategoryController::class, 'index'])->name('index');
            Route::get('/create', [PostCategoryController::class, 'create'])->name('create');
            Route::post('/store', [PostCategoryController::class, 'store'])->name('store');
            Route::get('/{id}', [PostCategoryController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PostCategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PostCategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [PostCategoryController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/status', [PostCategoryController::class, 'updateStatus'])->name('updateStatus');
        });

        // payment
        Route::resource('payment', PaymentController::class);

        // roomtype
        Route::prefix('room-types')->name('room-types.')->group(function () {
            Route::get('/', [RoomTypeController::class, 'index'])->name('index');
            Route::get('/create', [RoomTypeController::class, 'create'])->name('create');
            Route::post('/store', [RoomTypeController::class, 'store'])->name('store');
            Route::get('/{id}', [RoomTypeController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [RoomTypeController::class, 'edit'])->name('edit');
            Route::put('/{id}', [RoomTypeController::class, 'update'])->name('update');
            Route::delete('/{id}', [RoomTypeController::class, 'destroy'])->name('destroy');
            Route::get('trash', [RoomTypeController::class, 'trash'])->name('trash');
            Route::post('/{id}/restore', [RoomTypeController::class, 'restore'])->name('restore');
            Route::delete('/{id}/force-delete', [RoomTypeController::class, 'forceDelete'])->name('force-delete');
        });

        // About
        Route::prefix('abouts')->name('abouts.')->group(function () {
            Route::get('/', [AboutController::class, 'index'])->name('index');
            Route::get('/create', [AboutController::class, 'create'])->name('create');
            Route::post('/store', [AboutController::class, 'store'])->name('store');
            Route::get('/{id}', [AboutController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AboutController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AboutController::class, 'update'])->name('update');    
            Route::delete('/{id}', [AboutController::class, 'destroy'])->name('destroy');
        });
    });