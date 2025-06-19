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
use App\Http\Controllers\Admin\SaleRoomTypeController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\RoomTypeServiceController;
use App\Http\Controllers\Admin\RulesAndRegulationController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\RoomTypeImageController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeAmenityController;
use App\Http\Controllers\Admin\RoomTypeRulesAndRegulationController;
use App\Http\Controllers\Admin\RoomTypeServiceController as AdminRoomTypeServiceController;
use App\Http\Controllers\Admin\NewsCategoryController;
// Authentication routes

Route::get('/news', [PostController::class, 'indexClient'])->name('client.news.list');
Route::get('/news/category/{id}', [PostController::class, 'byCategory'])->name('client.news.category');
Route::get('/news/{id}', [PostController::class, 'showClient'])->name('client.news.detail');

Auth::routes();
require __DIR__.'/auth.php';

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
Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {
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

// Post routes
Route::prefix('posts')->as('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
});
    // payment
        Route::resource('payment', PaymentController::class);
    // sale
    Route::prefix('sale-room-types')->as('sale-room-types.')->group(function () {
        Route::get('/', [SaleRoomTypeController::class, 'index'])->name('index');
        Route::get('/create', [SaleRoomTypeController::class, 'create'])->name('create');
        Route::post('/', [SaleRoomTypeController::class, 'store'])->name('store');
        Route::get('/{id}', [SaleRoomTypeController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [SaleRoomTypeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SaleRoomTypeController::class, 'update'])->name('update');
        Route::delete('/{id}', [SaleRoomTypeController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/status', [SaleRoomTypeController::class, 'toggleStatus'])->name('toggle-status');
    });


});
    

        
