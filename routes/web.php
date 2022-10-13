<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\NewsCategoriesController;
use App\Http\Controllers\News\NewsIndexController;
use App\Http\Controllers\Users\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/auth', 'auth')->name('auth');
Route::view('/vue', 'vue')->name('vue');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'update'])->name('profile');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile
Route::get('/profile', [ProfileController::class, 'update'])
    ->name('profile')
    ->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])
    ->name('profile')
    ->middleware('auth')
    ->middleware('validator:App\Models\Users');

// News
Route::prefix('news')
    ->name('news.')
    ->group(function () {
        Route::get('/', [NewsIndexController::class, 'index'])->name('index');
        Route::get('/one/{news}', [NewsIndexController::class, 'show'])->name('show');
        Route::name('categories.')
            ->group(function () {
                Route::get('/categories', [NewsCategoriesController::class, 'index'])->name('index');
                Route::get('/category/{slug}', [NewsCategoriesController::class, 'show'])->name('show');
            });
    });

// Admin
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/image', [AdminIndexController::class, 'imageDownload'])->name('image');
        Route::match(['get', 'post'], '/download', [AdminIndexController::class, 'download'])->name('download');
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/categories', AdminCategoriesController::class);
        Route::resource('/users', AdminUsersController::class);
    });

// Export
Route::prefix('admin')
    ->name('admin.')
    ->match(['get', 'post'], '/download', [AdminIndexController::class, 'download'])->name('download');

// Auth
Auth::routes();
