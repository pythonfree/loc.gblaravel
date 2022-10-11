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
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::name('news.')
    ->prefix('news')
    ->group(function () {
        Route::get('/', [NewsIndexController::class, 'index'])->name('index');
        Route::get('/one/{news}', [NewsIndexController::class, 'show'])->name('show');
        Route::name('categories.')
            ->group(function () {
                Route::get('/categories', [NewsCategoriesController::class, 'index'])->name('index');
                Route::get('/category/{slug}', [NewsCategoriesController::class, 'show'])->name('show');
            });
    });


Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/image', [AdminIndexController::class, 'imageDownload'])->name('image');
        Route::match(['get', 'post'], '/download', [AdminIndexController::class, 'download'])->name('download');
        Route::resource('/news', AdminNewsController::class);


        Route::resources([
            '/categories' => AdminCategoriesController::class,
        ]);
        Route::resource('/categories', AdminCategoriesController::class)->only('index', 'store');
        Route::get('categories/edit/{category}', [AdminCategoriesController::class, 'edit'])->name('categories.edit');
        Route::get('categories/destroy/{category}', [AdminCategoriesController::class, 'destroy'])->name('categories.destroy');
        Route::post('categories/update/{category}', [AdminCategoriesController::class, 'update'])->name('categories.update');
    });

Auth::routes();
