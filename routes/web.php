<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PromotionController;

use App\Http\Controllers\Client\PromotionClientController;
use App\Http\Controllers\Client\PostClientController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Client\RoomTypeClientController;
use App\Http\Controllers\Admin\RuleAndRegulationController;
use App\Http\Controllers\Receptionist\GuestController;



Auth::routes();
require __DIR__ . '/auth.php';
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/', [HomeController::class, 'indexRoom'])->name('home');
});


Route::get('/', [HomeController::class, 'indexRoom'])->name('client.home');


// Public routes
Route::view('/', 'layout.client');
Route::get('/contacts/create', function () {
    return view('client.contact');
})->name('contacts.create');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/roomtypes/{id}', [HomeController::class, 'roomdetail'])->name('client.rooms.roomdetail');

Route::get('/roomtypes', [RoomTypeClientController::class, 'index'])->name('roomtypes');


// giảm giá 
Route::get('/promotions', [PromotionClientController::class, 'index'])->name('client.promotions.index');


Route::get('/tin-tuc', [PostClientController::class, 'index'])->name('client.posts.index');
Route::get('/tin-tuc/danh-muc/{id}', [PostClientController::class, 'byCategory'])->name('client.posts.byCategory');


// Authenticated routes
Route::get('/roomtypes', [RoomTypeClientController::class, 'index'])->name('roomtypes');

// Public routes


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

    Route::prefix('post')->as('post.')->group(function () {
        Route::get('/', [PostController::class, 'listPost'])->name('listPost');
        Route::get('/add-post', [PostController::class, 'addPost'])->name('addPost');
        Route::post('/add-post', [PostController::class, 'addPostPost'])->name('addPostPost');
        Route::get('/detail-post/{idPost}', [PostController::class, 'detailPost'])->name('detailPost');
        Route::delete('/delete-post', [PostController::class, 'deletePost'])->name('deletePost');
        Route::get('update-post/{idPost}', [PostController::class, 'updatePost'])->name('updatePost');
        Route::patch('update-post/{idPost}', [PostController::class, 'updatePatchPost'])->name('updatePatchPost');
    });

    // Room routes
    Route::prefix('rooms')->as('rooms.')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::get('/create', [RoomController::class, 'create'])->name('create');
        Route::post('/store', [RoomController::class, 'store'])->name('store');
        Route::get('/{id}', [RoomController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RoomController::class, 'update'])->name('update');
        Route::delete('/{id}', [RoomController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [RoomController::class, 'trash'])->name('trash');
        Route::post('/trash/restore/{id}', [RoomController::class, 'restore'])->name('restore');
        Route::delete('/trash/delete/{id}', [RoomController::class, 'forceDelete'])->name('forceDelete');
        Route::post('/{id}/status', [RoomController::class, 'updateStatus'])->name('updateStatus');
    });

    // service routes
    Route::prefix('services')->as('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/{id}', [ServiceController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');
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
        Route::get('/{id}', [BookingController::class, 'show'])->name('show');
    });

    // Amenities routes
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
});

// phần router cho lễ tân
Route::group([
    'prefix' => 'receptionist',
    'as' => 'receptionist.',
    // 'middleware' => 'auth' // Bảo vệ route admin, yêu cầu đăng nhập
],  function () {

    // Quản lý khách hàng
    Route::group([
        'prefix' => 'guests',
        'as' => 'guests.'
    ], function () {
        Route::get('/', [GuestController::class, 'listGuest'])->name('listGuest');
        Route::get('/add-guest', [GuestController::class, 'addGuest'])->name('addGuest');
        Route::post('/add-guest', [GuestController::class, 'addPostGuest'])->name('addPostGuest');
        Route::get('/detail-guest/{idGuest}', [GuestController::class, 'detailGuest'])->name('detailGuest');
        Route::delete('/delete-guest', [GuestController::class, 'deleteGuest'])->name('deleteGuest');
        Route::get('update-guest/{idGuest}', [GuestController::class, 'updateGuest'])->name('updateGuest');
        Route::patch('update-guest/{idGuest}', [GuestController::class, 'updatePatchGuest'])->name('updatePatchGuest');
    });
});


