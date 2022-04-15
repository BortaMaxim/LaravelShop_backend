<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API AppRoutes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'auth', 'middleware' => 'CORS'], function ($router) {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/user-info', [UserController::class, 'userInfo']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::post('/update-profile', [UserController::class, 'updateProfile']);
});

Route::get('categories', [CategoryController::class, 'getCategories']);
Route::get('categories/get-one/{id}', [CategoryController::class, 'categoriesGetOne']);
Route::get('products/limit/{limit}', [ProductController::class, 'getProductsLimit']);
Route::get('products/{id}/get-one', [ProductController::class, 'productGetOne']);
Route::post('products/filter', [ProductController::class, 'filterProducts']);
