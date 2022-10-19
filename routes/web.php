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
use App\Http\Controllers\Admin\AdminParserController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Auth\GithubLoginController;
use App\Http\Controllers\Auth\VKLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\NewsCategoriesController;
use App\Http\Controllers\News\NewsIndexController;
use App\Http\Controllers\Users\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/auth', 'auth')->name('auth');
Route::view('/vue', 'vue')->name('vue');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'update'])->name('profile');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile
Route::name('profile')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'update'])
            ->middleware('auth');
        Route::post('/profile', [ProfileController::class, 'update'])
            ->middleware('auth')
            ->middleware('validator:' . User::class);
    });

// News
Route::prefix('news')
    ->name('news.')
    ->group(function () {
        Route::get('/', [NewsIndexController::class, 'index'])->name('index');
        Route::get('/one/{news}', [NewsIndexController::class, 'show'])->name('show')
            ->middleware('auth');
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
        Route::get('/parser', [AdminParserController::class, 'index'])->name('parser');
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/categories', AdminCategoriesController::class);
        Route::resource('/users', AdminUsersController::class);
    });

// Export
Route::prefix('admin')
    ->name('admin.')
    ->match(['get', 'post'], '/download', [AdminIndexController::class, 'download'])->name('download');

// Socialite LoginVK
Route::get('/auth/vk/redirect', [VKLoginController::class, 'redirect'])->name('LoginVK');
Route::get('/auth/vk/callback', [VKLoginController::class, 'callback'])->name('LoginVKResponse');

// Socialite LoginGithub
Route::get('/auth/github/redirect', [GithubLoginController::class, 'redirect'])->name('LoginGithub');
Route::get('/auth/github/callback', [GithubLoginController::class, 'callback'])->name('LoginGithubResponse');

// Laravel-filemanager
Route::group([
    'prefix' => 'laravel-filemanager',
    'middleware' => ['web', 'auth', 'isAdmin']
], function () {
    Lfm::routes();
});

// Auth IN END !!!ALWAYS!!!
Auth::routes();
