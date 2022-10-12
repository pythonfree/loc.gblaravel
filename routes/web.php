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

use App\Http\Controllers\Admin\AdminProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\News\NewsCategoriesController;
use App\Http\Controllers\News\NewsIndexController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/auth', 'auth')->name('auth');
Route::view('/vue', 'vue')->name('vue');
//Route::get('/home', [HomeController::class, 'index'])->name('home');

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

Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/image', [AdminIndexController::class, 'imageDownload'])->name('image');
        Route::match(['get', 'post'], '/download', [AdminIndexController::class, 'download'])->name('download');
        Route::match(['get', 'post'], '/profile', [AdminProfileController::class, 'update'])->name('updateProfile');
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/categories', AdminCategoriesController::class);
    });

//Auth::routes();
Auth::routes(['register' => false]);
//Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
//Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
//Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');

