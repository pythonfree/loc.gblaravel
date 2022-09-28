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

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])                                                   ->name('home');
Route::view('/about', 'about')                                                                 ->name('about');
Route::view('/auth', 'auth')                                                                   ->name('auth');

Route::prefix('news')
    ->group(function () {
        Route::get('/', [NewsController::class, 'index'])                                           ->name('news.index');
        Route::get('/{name}/{id}', [NewsController::class, 'show'])
            ->where(['name' => '[a-z]+', 'id' => '[0-9]+'])                                             ->name('news.show');
        Route::get('/categories', [CategoriesController::class, 'index'])                           ->name('categories.index');
        Route::get('/{name}', [CategoriesController::class, 'show'])->where(['name' => '[a-z]+'])   ->name('categories.show');

    });


Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [IndexController::class, 'index'])                                          ->name('index');
        Route::get('/add_article', [IndexController::class, 'addArticle'])                          ->name('add_article');
        Route::get('/test1', [IndexController::class, 'test1'])                                     ->name('test1');
        Route::get('/test2', [IndexController::class, 'test2'])                                     ->name('test2');
    });
