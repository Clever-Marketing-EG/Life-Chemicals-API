<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SheetsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Products Routes
Route::apiResource('products', ProductController::class);
Route::get('products/search/{searchTerm}', [SearchController::class, 'products'])->name('search.products');

// Categories Routes
Route::apiResource('categories', CategoryController::class);
Route::get('categories/{category}/products', [CategoryController::class, 'products'])->name('categories.products.index');
Route::get('categories/search/{searchTerm}', [SearchController::class, 'categories'])->name('search.categories');
// Articles Routes
Route::apiResource('articles', ArticleController::class);
Route::get('articles/search/{searchTerm}', [SearchController::class, 'articles'])->name('search.articles');
// Dashboard meta routes
Route::group([
    'prefix' => 'meta'
], function() {
    Route::get('products', [ProductController::class, 'meta'])->name('meta.products');
    Route::get('categories', [CategoryController::class, 'meta'])->name('meta.categories');
    Route::get('articles', [ArticleController::class, 'meta'])->name('meta.articles');
});
// Images routes
Route::group([
    'prefix' => 'images'
], function() {
    Route::post('products', [ImagesController::class, 'products'])->name('images.products');
    Route::post('categories', [ImagesController::class, 'categories'])->name('images.categories');
    Route::post('articles', [ImagesController::class, 'articles'])->name('images.articles');
    Route::post('meta', [ImagesController::class, 'metas'])->name('images.metas');
});

// Data routes
Route::group([
    'prefix' => 'data'
], function() {
    Route::get('/all', [MetaController::class, 'all']);
    Route::get('/all/{page}', [MetaController::class, 'allinpage']);
    Route::get('/text', [MetaController::class, 'text']);
    Route::get('/text/{id}', [MetaController::class, 'texta']);
    Route::get('/text/page/{page}', [MetaController::class, 'textp']);
    Route::get('/image/{id}', [MetaController::class, 'imagea']);
    Route::get('/image/page/{page}', [MetaController::class, 'imagep']);
    Route::get('/image', [MetaController::class, 'imgs']);
    Route::post('/', [MetaController::class, 'store'])->middleware('auth:api');
    Route::get('/meta', [MetaController::class, 'collected']);
});


// Authentication routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
    Route::get('/user-profile', [AuthController::class, 'userProfile'])->name('auth.profile');
    Route::post('/forgot-password', [AuthController::class, 'sendResetPasswordEmail'])->name('password.reset');
    Route::get('/forgot-password', [AuthController::class, 'passwordResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'passwordResetSubmission'])->name('password.update');
});
Route::post('/sheet',[SheetsController::class,'sheets'])->name('sheet.upload');
