<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RuleAndRegulationController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\RoomTypeImageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\admin\ServicePlusController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\SaleRoomTypeController;
use App\Http\Controllers\Admin\RefundPolicyController;
use App\Http\Controllers\Admin\StaffShiftController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RefundController;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PostClientController;
use App\Http\Controllers\Client\PromotionClientController;
use App\Http\Controllers\Client\RoomTypeClientController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\FaqClientController;
use App\Http\Controllers\Client\BookingController as ClientBookingController;
use App\Http\Controllers\Client\AboutController as ClientAboutController;
use App\Http\Controllers\Client\SystemController as ClientSystemController;

use App\Http\Controllers\ReviewController;
use App\Http\Middleware\CheckAdminAccess;

// Laravel Auth
Auth::routes();
require __DIR__ . '/auth.php';

// ------------------- CLIENT ROUTES -------------------
Route::prefix('client')->name('client.')->group(function () {
    // Trang chủ + tìm kiếm
    Route::get('/', [HomeController::class, 'indexRoom'])->name('home');
    Route::get('/roomtypes/{id}', [HomeController::class, 'roomdetail'])->name('rooms.roomdetail');
});

//system
Route::get('/system', [ClientSystemController::class, 'index'])->name('client.system.index');

//about
Route::prefix('about')->as('client.about.')->group(function () {
    Route::get('/', [ClientAboutController::class, 'index'])->name('index');
});

//faq
Route::get('/faqs', [FaqClientController::class, 'index'])->name('client.faqs.index');
Route::post('/faqs/submit', [FaqClientController::class, 'submit'])->name('client.faqs.submit');


// Phòng
Route::get('/roomtypes', [RoomTypeClientController::class, 'index'])->name('roomtypes');

// giảm giá 
Route::get('/promotions', [PromotionClientController::class, 'index'])->name('client.promotions.index');

// router tin tức client
Route::get('/tin-tuc', [PostClientController::class, 'index'])->name('client.posts.index');
Route::get('/tin-tuc/{post:slug}', [PostClientController::class, 'show'])->name('client.posts.show');
Route::get('/tin-tuc/danh-muc/{id}', [PostClientController::class, 'byCategory'])->name('client.posts.byCategory');

// Liên hệ
Route::get('/contacts/create', fn() => view('client.contact'))->name('contacts.create');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');

// Hồ sơ người dùng
Route::get('/profileUse/{id}/edit', [UserController::class, 'edit'])->name('profileUse.edit');
Route::put('/profileUse/{id}', [UserController::class, 'update'])->name('profileUse.update');

// ------------------- PUBLIC ROUTES -------------------
Route::get('/', [HomeController::class, 'indexRoom'])->name('home');

// ------------------- AUTHENTICATED USER ROUTES -------------------
Route::middleware('auth')->group(function () {
    Route::view('profile', 'profile')->name('profile');

    Route::middleware('verified')->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

    // Review
    Route::get('/review-form/{bookingID}', [ReviewController::class, 'reviewForm'])->name('review-form');
    Route::post('/submit-review/{bookingID}', [ReviewController::class, 'submitReview'])->name('submit-review');
});

// ------------------- ADMIN ROUTES -------------------
Route::prefix('admin')->as('admin.')->middleware('auth', CheckAdminAccess::class)->group(function () {
    // Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('faqs', FaqController::class);
    Route::patch('faqs/{faq}/restore', [FaqController::class, 'restore'])->name('faqs.restore');
    Route::delete('faqs/{faq}/force-delete', [FaqController::class, 'forceDelete'])->name('faqs.forceDelete');

    //systems 
    Route::prefix('system')->as('system.')->group(function () {
        Route::get('/', [SystemController::class, 'index'])->name('index');
        Route::get('/create', [SystemController::class, 'create'])->name('create');
        Route::post('/store', [SystemController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SystemController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SystemController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SystemController::class, 'destroy'])->name('destroy');
    });

    // Banners
    Route::prefix('banners')->as('banners.')->group(function () {
        Route::get('/', [BannerController::class, 'listBanner'])->name('listBanner');
        Route::get('/add', [BannerController::class, 'addBanner'])->name('addBanner');
        Route::post('/add', [BannerController::class, 'addPostBanner'])->name('addPostBanner');
        Route::get('/{idbanner}', [BannerController::class, 'detailBanner'])->name('detailBanner');
        Route::delete('/delete', [BannerController::class, 'deleteBanner'])->name('deleteBanner');
        Route::get('/{idBanner}/edit', [BannerController::class, 'updateBanner'])->name('updateBanner');
        Route::patch('/{idBanner}', [BannerController::class, 'updatePatchBanner'])->name('updatePatchBanner');
    });

    //about
    Route::prefix('about')->as('about.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('/edit', [AboutController::class, 'edit'])->name('edit');
        Route::post('/update', [AboutController::class, 'update'])->name('update');
        Route::get('/create', [AboutController::class, 'create'])->name('create');
        Route::post('/store', [AboutController::class, 'store'])->name('store');
        Route::delete('/{id}', [AboutController::class, 'destroy'])->name('destroy');
    });

    // Staffs
    Route::prefix('staffs')->as('staffs.')->group(function () {
        Route::get('/', [StaffController::class, 'listStaff'])->name('listStaff');
        Route::get('/add', [StaffController::class, 'addStaff'])->name('addStaff');
        Route::post('/add', [StaffController::class, 'addPostStaff'])->name('addPostStaff');
        Route::get('/{idStaff}', [StaffController::class, 'detailStaff'])->name('detailStaff');
        Route::delete('/delete', [StaffController::class, 'deleteStaff'])->name('deleteStaff');
        Route::get('/{idStaff}/edit', [StaffController::class, 'updateStaff'])->name('updateStaff');
        Route::patch('/{idStaff}', [StaffController::class, 'updatePatchStaff'])->name('updatePatchStaff');
    });

    // Staff_shifts
    Route::prefix('staff_shifts')->as('staff_shifts.')->group(function () {
        Route::get('/', [StaffShiftController::class, 'index'])->name('index');
        Route::get('/create', [StaffShiftController::class, 'create'])->name('create');
        Route::post('/store', [StaffShiftController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [StaffShiftController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/{id}', [StaffShiftController::class, 'update'])->name('update');
        Route::delete('/{id}', [StaffShiftController::class, 'destroy'])->name('destroy');
    });

    // Contacts
    Route::prefix('contacts')->as('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{id}', [ContactController::class, 'show'])->name('show');
        Route::post('/{id}/status', [ContactController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
    });

    //  đánhgias-reviews
    Route::prefix('reviews')->as('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        // Route::get('/{id}', [ReviewController::class, 'show'])->name('show');
        Route::post('/{id}/response', [ReviewController::class, 'updateResponse'])->name('updateResponse');
        // Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('destroy');
    });

    // Admin_Accounts
    Route::prefix('admin_accounts')->as('admin_accounts.')->group(function () {
        Route::get('/', [AdminAccountController::class, 'index'])->name('index');
        Route::get('{id}/edit', [AdminAccountController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [AdminAccountController::class, 'update'])->name('update');
    });

    // Users
    Route::prefix('users')->as('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        // Route::post('/{id}/status', [UserController::class, 'updateStatus'])->name('updateStatus');
        // Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });


    // Post Categories
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

    // Posts
    Route::prefix('post')->as('post.')->group(function () {
        Route::get('/', [PostController::class, 'listPost'])->name('listPost');
        Route::get('/add-post', [PostController::class, 'addPost'])->name('addPost');
        Route::post('/add-post', [PostController::class, 'addPostPost'])->name('addPostPost');
        Route::get('/detail-post/{idPost}', [PostController::class, 'detailPost'])->name('detailPost');
        Route::delete('/delete-post', [PostController::class, 'deletePost'])->name('deletePost');
        Route::get('update-post/{idPost}', [PostController::class, 'updatePost'])->name('updatePost');
        Route::patch('update-post/{idPost}', [PostController::class, 'updatePatchPost'])->name('updatePatchPost');
    });

    // Rooms
    Route::prefix('rooms')->as('rooms.')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::get('/create', [RoomController::class, 'create'])->name('create');
        Route::post('/store', [RoomController::class, 'store'])->name('store');
        Route::get('/{id}', [RoomController::class, 'show'])->name('show');
        Route::get('/booked', [RoomController::class, 'bookedRooms'])->name('booked');
        Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RoomController::class, 'update'])->name('update');
        Route::delete('/{id}', [RoomController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [RoomController::class, 'trash'])->name('trash');
        Route::post('/trash/restore/{id}', [RoomController::class, 'restore'])->name('restore');
        Route::delete('/trash/delete/{id}', [RoomController::class, 'forceDelete'])->name('forceDelete');
        Route::post('/{id}/status', [RoomController::class, 'updateStatus'])->name('updateStatus');
    });

    // Services
    Route::prefix('services')->as('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/{id}', [ServiceController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');
    });

    // Services plusspluss
    Route::prefix('servicesPlus')->as('servicesPlus.')->group(function () {
        Route::get('/', [ServicePlusController::class, 'index'])->name('index');
        Route::get('/create', [ServicePlusController::class, 'create'])->name('create');
        Route::post('/store', [ServicePlusController::class, 'store'])->name('store');
        Route::get('/{id}', [ServicePlusController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ServicePlusController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ServicePlusController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServicePlusController::class, 'destroy'])->name('destroy');
    });

    // Payments
    Route::resource('payment', PaymentController::class);

    // Bookings
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

    // Amenities
    Route::prefix('amenities')->as('amenities.')->group(function () {
        Route::get('/', [AmenityController::class, 'index'])->name('index');
        Route::get('/create', [AmenityController::class, 'create'])->name('create');
        Route::post('/store', [AmenityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AmenityController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AmenityController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AmenityController::class, 'destroy'])->name('destroy');
    });

    // Rules & Regulations
    Route::prefix('rules')->as('rules.')->group(function () {
        Route::get('/', [RuleAndRegulationController::class, 'index'])->name('index');
        Route::get('/create', [RuleAndRegulationController::class, 'create'])->name('create');
        Route::post('/store', [RuleAndRegulationController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RuleAndRegulationController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RuleAndRegulationController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [RuleAndRegulationController::class, 'destroy'])->name('destroy');
    });

    // Promotions
    Route::prefix('promotions')->as('promotions.')->group(function () {
        Route::get('/', [PromotionController::class, 'index'])->name('index');
        Route::get('/create', [PromotionController::class, 'create'])->name('create');
        Route::post('/store', [PromotionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PromotionController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PromotionController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PromotionController::class, 'destroy'])->name('destroy');
    });

    // Route loại phòng
    Route::prefix('roomtypes')->name('roomtypes.')->group(function () {
        Route::get('/', [RoomTypeController::class, 'index'])->name('index');
        Route::get('/create', [RoomTypeController::class, 'create'])->name('create');
        Route::post('/store', [RoomTypeController::class, 'store'])->name('store');
        Route::get('/{id}', [RoomTypeController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [RoomTypeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RoomTypeController::class, 'update'])->name('update');
        Route::delete('/{id}', [RoomTypeController::class, 'destroy'])->name('destroy');

        // Route ảnh loại phòng — PHẢI NẰM TRONG roomtypes
        Route::prefix('{roomType}/images')->name('images.')->group(function () {
            Route::get('/', [RoomTypeImageController::class, 'index'])->name('index');
            Route::get('/create', [RoomTypeImageController::class, 'create'])->name('create');
            Route::post('/', [RoomTypeImageController::class, 'store'])->name('store');
            Route::get('/{image}/edit', [RoomTypeImageController::class, 'edit'])->name('edit');
            Route::put('/{image}', [RoomTypeImageController::class, 'update'])->name('update');
            Route::delete('/{image}', [RoomTypeImageController::class, 'destroy'])->name('destroy');
        });
    });

    // reviews
    Route::prefix('reviews')->as('reviews.')->group(function () {
        Route::get('/', [AdminReviewController::class, 'index'])->name('index');
        Route::get('{review}/show', [AdminReviewController::class, 'show'])->name('show');
        Route::post('{review}/response', [AdminReviewController::class, 'response'])->name('response');
        Route::delete('{review}/destroy', [AdminReviewController::class, 'destroy'])->name('destroy');
    });

    // chính sách hoàn tiền
    Route::prefix('refund-policies')->as('refund-policies.')->group(function () {
        Route::get('/', [RefundPolicyController::class, 'index'])->name('index');
        Route::get('/create', [RefundPolicyController::class, 'create'])->name('create');
        Route::post('/store', [RefundPolicyController::class, 'store'])->name('store');
        Route::get('/show/{id}', [RefundPolicyController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [RefundPolicyController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RefundPolicyController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [RefundPolicyController::class, 'destroy'])->name('destroy');
    });

    // Route sale theo loại phòng
    Route::prefix('admin/sale-room-types')->name('sale_room_types.')->group(function () {
        Route::get('/', [SaleRoomTypeController::class, 'index'])->name('index');
        Route::get('/create', [SaleRoomTypeController::class, 'create'])->name('create');
        Route::post('/store', [SaleRoomTypeController::class, 'store'])->name('store');
        Route::get('/{id}', [SaleRoomTypeController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [SaleRoomTypeController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [SaleRoomTypeController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SaleRoomTypeController::class, 'destroy'])->name('destroy');
    });

Route::prefix('refunds')->as('refunds.')->group(function  () {
    Route::get('/', [RefundController::class, 'index'])->name('index');
    Route::get('/create', [RefundController::class, 'create'])->name('create');
    Route::post('/store', [RefundController::class, 'store'])->name('store');
    Route::get('/{id}', [RefundController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [RefundController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [RefundController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [RefundController::class, 'destroy'])->name('destroy');
});
Route::prefix('roles')->name('roles.')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/store', [RoleController::class, 'store'])->name('store');
    Route::get('/show/{id}', [RoleController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
});



});


Route::prefix('bookings')
    ->as('bookings.')
    // ->middleware('auth') // Nếu client cần đăng nhập
    ->group(function () {
        Route::get('/', [ClientBookingController::class, 'index'])->name('index');
        Route::get('/create', [ClientBookingController::class, 'create'])->name('create');
        Route::post('/confirm', [ClientBookingController::class, 'confirm'])->name('confirm'); // Chuyển từ create sang confirm
        Route::post('/store', [ClientBookingController::class, 'store'])->name('store'); // Lưu dữ liệu từ confirm
        Route::get('{id}/returnVnpay', [ClientBookingController::class, 'returnVnpay'])->name('return.vnpay');
        Route::get('{id}/show', [ClientBookingController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ClientBookingController::class, 'edit'])->name('edit');
        Route::put('{id}', [ClientBookingController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [ClientBookingController::class, 'destroy'])->name('destroy');
        Route::post('/check-promotion', [ClientBookingController::class, 'checkPromotion'])->name('check-promotion');

        Route::get('/payment/callback', [ClientBookingController::class, 'paymentCallback'])->name('payment.callback');
        Route::get('/success', [ClientBookingController::class, 'success'])->name('success');
        Route::post('{id}/process-next-payment', [ClientBookingController::class, 'processNextPayment'])->name('process-next-payment');
    });