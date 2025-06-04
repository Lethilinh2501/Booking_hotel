<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;

// http://127.0.0.1:8000/admin/products/update-products
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    // 'middleware' => 'auth' // Bảo vệ route admin, yêu cầu đăng nhập
],  function () {
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
});
