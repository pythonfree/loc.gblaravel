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

use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\IndexController as NewsIndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/auth', 'auth')->name('auth');
Route::view('/vue', 'vue')->name('vue');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', [NewsIndexController::class, 'index'])->name('index');
        Route::get('/{slug}/{id}', [NewsIndexController::class, 'show'])
            ->where(['slug' => '[a-z]+', 'id' => '[0-9]+'])->name('show');
        Route::name('categories.')
            ->group(function () {
                Route::get('/categories', [CategoriesController::class, 'index'])->name('index');
                Route::get('/{slug}', [CategoriesController::class, 'show'])->where(['slug' => '[a-z]+'])->name('show');
            });
    });


Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index');
        Route::match(['get', 'post'], '/create', [AdminIndexController::class, 'create'])->name('create');
        Route::get('/image', [AdminIndexController::class, 'imageDownload'])->name('image');
        Route::match(['get', 'post'],'/download', [AdminIndexController::class, 'download'])->name('download');
    });

Auth::routes();
