<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;

// http://127.0.0.1:8000/admin/products/update-products

Route::get('/', function () {
    return view('layout.client');
});


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    // 'middleware' => 'auth' // Bảo vệ route admin, yêu cầu đăng nhập
],  function () {

    Route::get('/', function () {
        return view('layout.default.admin');
    });

    Route::group([
        'prefix' => 'banners',
        'as' => 'banners.'
    ], function () {
        Route::get('/', [BannerController::class, 'listBanner'])->name('listBanner');
        Route::get('/add-banner', [BannerController::class, 'addBanner'])->name('addBanner');
        Route::post('/add-banner', [BannerController::class, 'addPostBanner'])->name('addPostBanner');
        Route::get('/detail-banner/{idbanner}', [BannerController::class, 'detailBanner'])->name('detailBanner');
        Route::delete('/delete-banner', [BannerController::class, 'deleteBanner'])->name('deleteBanner');
        Route::get('update-banner/{idBanner}', [BannerController::class, 'updateBanner'])->name('updateBanner');
        Route::patch('update-banner/{idBanner}', [BannerController::class, 'updatePatchBanner'])->name('updatePatchBanner');
    });

    Route::group([
        'prefix' => 'staffs',
        'as' => 'staffs.'
    ], function () {
        Route::get('/', [StaffController::class, 'listStaff'])->name('listStaff');
        Route::get('/add-staff', [StaffController::class, 'addStaff'])->name('addStaff');
        Route::post('/add-staff', [StaffController::class, 'addPostStaff'])->name('addPostStaff');
        Route::get('/detail-staff/{idStaff}', [StaffController::class, 'detailStaff'])->name('detailStaff');
        Route::delete('/delete-staff', [StaffController::class, 'deleteStaff'])->name('deleteStaff');
        Route::get('update-staff/{idStaff}', [StaffController::class, 'updateStaff'])->name('updateStaff');
        Route::patch('update-staff/{idStaff}', [StaffController::class, 'updatePatchStaff'])->name('updatePatchStaff');
    });

    // Contact routes
    Route::group([
        'prefix' => 'contacts',
        'as' => 'contacts.'
    ], function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{id}', [ContactController::class, 'show'])->name('show');
        Route::post('/{id}/status', [ContactController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
    });

    // Post Category
    Route::group([
        'prefix' => 'postcategory',
        'as' => 'postcategory.'
    ], function () {
        Route::get('/', [PostCategoryController::class, 'index'])->name('index');
        Route::get('/create', [PostCategoryController::class, 'create'])->name('create');
        Route::post('/store', [PostCategoryController::class, 'store'])->name('store');
        Route::get('/{id}', [PostCategoryController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PostCategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PostCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostCategoryController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/status', [PostCategoryController::class, 'updateStatus'])->name('update-status');
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
    });
});
