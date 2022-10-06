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

use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\News\CategoriesController as NewsCategoriesController;
use App\Http\Controllers\News\IndexController  as NewsIndexController;


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


Route::name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [AdminNewsController::class, 'index'])->name('index');
        Route::match(['get', 'post'], '/create', [AdminNewsController::class, 'create'])->name('create');
        Route::get('news/edit/{article}', [AdminNewsController::class, 'edit'])->name('edit');
        Route::get('news/destroy/{article}', [AdminNewsController::class, 'destroy'])->name('destroy');
        Route::post( 'news/update/{article}', [AdminNewsController::class, 'update'])->name('update');

        Route::get('/image', [AdminIndexController::class, 'imageDownload'])->name('image');
        Route::match(['get', 'post'],'/download', [AdminIndexController::class, 'download'])->name('download');


        Route::resources([
            '/categories' => AdminCategoriesController::class,
        ]);
        Route::resource('/categories', AdminCategoriesController::class)->only('index', 'store');
        Route::get('categories/edit/{category}', [AdminCategoriesController::class, 'edit'])->name('categories.edit');
        Route::get('categories/destroy/{category}', [AdminCategoriesController::class, 'destroy'])->name('categories.destroy');
        Route::post('categories/update/{category}', [AdminCategoriesController::class, 'update'])->name('categories.update');
    });

Auth::routes();
