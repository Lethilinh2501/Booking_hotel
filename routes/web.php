<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Auth::routes();
require __DIR__.'/auth.php';




Route::view('/', 'layout.client');
// Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::view('profile', 'profile')->name('profile');
});


/*
|--------------------------------------------------------------------------
| Admin Routes (Prefix: admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    // Staff Routes
    Route::prefix('staffs')->name('staffs.')->group(function () {
        Route::get('/', [StaffController::class, 'listStaff'])->name('list');
        Route::get('/add', [StaffController::class, 'addStaff'])->name('add');
        Route::post('/add', [StaffController::class, 'addPostStaff'])->name('store');
        Route::get('/{idStaff}', [StaffController::class, 'detailStaff'])->name('detail');
        Route::delete('/delete', [StaffController::class, 'deleteStaff'])->name('delete');
        Route::get('/update/{idStaff}', [StaffController::class, 'updateStaff'])->name('edit');
        Route::patch('/update/{idStaff}', [StaffController::class, 'updatePatchStaff'])->name('update');
    });

    // Contact Routes
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{id}', [ContactController::class, 'show'])->name('show');
        Route::post('/{id}/status', [ContactController::class, 'updateStatus'])->name('status');
        Route::delete('/{id}', [ContactController::class, 'destroy'])->name('delete');
    });

    // Category Routes
    Route::prefix('categories')->name('categories.')->group(function () {
        // Route::get('/', [CategoryController::class, 'index'])->name('index');
        // Route::get('/create', [CategoryController::class, 'create'])->name('create');
        // Route::post('/store', [CategoryController::class, 'store'])->name('store');
        // Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
        // Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        // Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
        // Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('delete');
        // Route::post('/{id}/status', [CategoryController::class, 'updateStatus'])->name('status');
    });

    // Post Routes
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'listPost'])->name('index');
        Route::get('/create', [PostController::class, 'addPost'])->name('create');
        Route::post('/store', [PostController::class, 'addPostPost'])->name('store');
        Route::get('/{idPost}', [PostController::class, 'detailPost'])->name('show');
        Route::delete('/delete', [PostController::class, 'deletePost'])->name('delete');
        Route::get('/update/{idPost}', [PostController::class, 'updatePost'])->name('edit');
        Route::patch('/update/{idPost}', [PostController::class, 'updatePatchPost'])->name('update');
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
