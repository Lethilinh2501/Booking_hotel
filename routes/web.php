<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Client\RoomTypeController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\RuleAndRegulationController;

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
// Trang chủ
Route::get('/', [HomeController::class, 'indexRoom'])->name('home');

// // Route client riêng
// Route::prefix('client')->as('client.')->group(function () {
//     // Trang chính client
//     Route::get('/', function () {
//         return view('client.index');
//     })->name('home');

//     // Danh sách phòng
//     Route::get('/rooms', [RoomTypeController::class, 'index'])->name('rooms.index');
// });

// // Public route
// Route::get('/roomtypes', [RoomTypeController::class, 'index'])->name('roomtypes');

// // Authenticated routes
// Route::middleware('auth')->group(function () {
//     Route::view('profile', 'profile')->name('profile');

//     Route::middleware('verified')->group(function () {
//         Route::view('dashboard', 'dashboard')->name('dashboard');
//     });

//     // Đánh giá phòng
//     Route::get('/review-form/{bookingID}', [ReviewController::class, 'reviewForm'])->name('review-form');
//     Route::post('/submit-review/{bookingID}', [ReviewController::class, 'submitReview'])->name('submit-review');
// });


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

    Route::group([
        'prefix' => 'post',
        'as' => 'post.'
    ], function () {
        Route::get('/', [PostController::class, 'listPost'])->name('listPost');
        Route::get('/add-post', [PostController::class, 'addPost'])->name('addPost');
        Route::post('/add-post', [PostController::class, 'addPostPost'])->name('addPostPost');
        Route::get('/detail-post/{idPost}', [PostController::class, 'detailPost'])->name('detailPost');
        Route::delete('/delete-post', [PostController::class, 'deletePost'])->name('deletePost');
        Route::get('update-post/{idPost}', [PostController::class, 'updatePost'])->name('updatePost');
        Route::patch('update-post/{idPost}', [PostController::class, 'updatePatchPost'])->name('updatePatchPost');

        // payment
        Route::resource('payment', PaymentController::class);
    });

    // payment
    Route::resource('payment', PaymentController::class);
        // Order routes
  Route::prefix('bookings')->as('bookings.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::get('/create', [BookingController::class, 'create'])->name('create');
    Route::post('/store', [BookingController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [BookingController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [BookingController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [BookingController::class, 'destroy'])->name('destroy');
    Route::post('/update-status/{id}', [BookingController::class, 'updateStatus'])->name('updateStatus');
});
// Amenities routes — đây nè, sửa lại đưa vào cùng group admin như trên
    Route::prefix('amenities')->as('amenities.')->group(function () {
        Route::get('/', [AmenityController::class, 'index'])->name('index');
        Route::get('/create', [AmenityController::class, 'create'])->name('create');
        Route::post('/store', [AmenityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AmenityController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AmenityController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AmenityController::class, 'destroy'])->name('destroy');
    });
Route::prefix('rules')->as('rules.')->group(function () {
        Route::get('/', [RuleAndRegulationController::class, 'index'])->name('index');
        Route::get('/create', [RuleAndRegulationController::class, 'create'])->name('create');
        Route::post('/store', [RuleAndRegulationController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RuleAndRegulationController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RuleAndRegulationController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [RuleAndRegulationController::class, 'destroy'])->name('destroy');
    });
    // Promotions routes
Route::prefix('promotions')->as('promotions.')->group(function () {
    Route::get('/', [PromotionController::class, 'index'])->name('index');
    Route::get('/create', [PromotionController::class, 'create'])->name('create');
    Route::post('/store', [PromotionController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PromotionController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PromotionController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [PromotionController::class, 'destroy'])->name('destroy');
});

// // Client room routes
// Route::prefix('client/rooms')->as('client.rooms.')->group(function () {
//     Route::get('/', [RoomTypeController::class, 'index'])->name('index');
//     Route::get('/{id}', [RoomTypeController::class, 'show'])->name('show');
// });

 });
