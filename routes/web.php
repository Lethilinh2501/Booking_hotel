<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;

// http://127.0.0.1:8000/admin/products/update-products

Route::get('/', function () {
    return view('layout.client');
});
Route::get('/admin', function () {
    return view('layout.admin');
});

// Route::group([
//     'prefix' => 'admin',
//     'as' => 'admin.',
//     // 'middleware' => 'auth' // Bảo vệ route admin, yêu cầu đăng nhập
// ],  function () {
//     Route::group([
//         'prefix' => 'banners',
//         'as' => 'banners.'
//     ], function () {
//         Route::get('/', [BannerController::class, 'listBanner'])->name('listBanner');
//         Route::get('/add-banner', [BannerController::class, 'addBanner'])->name('addBanner');
//         Route::post('/add-banner', [BannerController::class, 'addPostBanner'])->name('addPostBanner');
//         Route::get('/detail-banner/{idbanner}', [BannerController::class, 'detailBanner'])->name('detailBanner');
//         Route::delete('/delete-banner', [BannerController::class, 'deleteBanner'])->name('deleteBanner');
//         Route::get('update-banner/{idBanner}', [BannerController::class, 'updateBanner'])->name('updateBanner');
//         Route::patch('update-banner/{idBanner}', [BannerController::class, 'updatePatchBanner'])->name('updatePatchBanner');
//     });

//     Route::group([
//         'prefix' => 'staffs',
//         'as' => 'staffs.'
//     ], function () {
//         Route::get('/', [StaffController::class, 'listStaff'])->name('listStaff');
//         Route::get('/add-staff', [StaffController::class, 'addStaff'])->name('addStaff');
//         Route::post('/add-staff', [StaffController::class, 'addPostStaff'])->name('addPostStaff');
//         Route::get('/detail-staff/{idStaff}', [StaffController::class, 'detailStaff'])->name('detailStaff');
//         Route::delete('/delete-staff', [StaffController::class, 'deleteStaff'])->name('deleteStaff');
//         Route::get('update-staff/{idStaff}', [StaffController::class, 'updateStaff'])->name('updateStaff');
//         Route::patch('update-staff/{idStaff}', [StaffController::class, 'updatePatchStaff'])->name('updatePatchStaff');
//     });

//     // Contact routes
//     Route::group([
//         'prefix' => 'contacts',
//         'as' => 'contacts.'
//     ], function () {
//         Route::get('/', [ContactController::class, 'index'])->name('index');
//         Route::get('/{id}', [ContactController::class, 'show'])->name('show');
//         Route::post('/{id}/status', [ContactController::class, 'updateStatus'])->name('updateStatus');
//         Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
//     });

//        // Category routes
//         Route::group([
//         'prefix' => 'categories',
//         'as' => 'categories.'
//     ], function () {
//         Route::get('/', [CategoryController::class, 'index'])->name('index');
//         Route::get('/create', [CategoryController::class, 'create'])->name('create');
//         Route::post('/store', [CategoryController::class, 'store'])->name('store');
//         Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
//         Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
//         Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
//         Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
//         Route::post('/{id}/status', [CategoryController::class, 'updateStatus'])->name('update-status');
//     });
// });
