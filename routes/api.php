<?php

use App\Http\Controllers\CategoriesManagementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ISOCountriesController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsManagementController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagmentController;
use App\Http\Controllers\VerificationController;
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
    //Email verification
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle'])
        ->name('verification.verify');
    Route::get('/email/resend', [VerificationController::class, 'resend'])
        ->middleware('auth:api', 'throttle')
        ->name('verification.send');

    //Admin - UserManagement
    Route::group(['middleware' => 'admin'], function ($router) {
        Route::get('/get-users', [UserManagmentController::class, 'getUsers']);
        Route::get('/get-one-user/{id}', [UserManagmentController::class, 'getOneUsers']);
        Route::post('/create-users', [UserManagmentController::class, 'createUsers']);
        Route::post('/update-users/{id}', [UserManagmentController::class, 'updateUsers']);
        Route::delete('/delete-users/{id}', [UserManagmentController::class, 'deleteUsers']);
        //Admin - CategoriesManagement
        Route::post('/categories/create', [CategoriesManagementController::class, 'createCategory']);
        Route::get('/categories/view-one/{id}', [CategoriesManagementController::class, 'viewOneCategory']);
        Route::post('/categories/update/{id}', [CategoriesManagementController::class, 'updateCategory']);
        Route::delete('/categories/delete/{id}', [CategoriesManagementController::class, 'deleteCategory']);
    });
    Route::group(['middleware' => 'manager'], function ($router) {
        //Manager - ProductsManagement
        Route::get('/get-all-products', [ProductsManagementController::class, 'getAllProducts']);
        Route::get('/get-one-product/{id}', [ProductsManagementController::class, 'getOneProduct']);
        Route::post('/get-products/create', [ProductsManagementController::class, 'createProduct']);
        Route::post('/get-products/update/{id}', [ProductsManagementController::class, 'updateProduct']);
        Route::delete('/get-products/delete/{id}', [ProductsManagementController::class, 'deleteProduct']);
    });
    //Stripe
    Route::get('/stripe', [StripeController::class, 'stripe']);
    Route::post('/stripe', [StripeController::class, 'stripePost']);
    //Comments - Products
    Route::post('/comments/{id}', [CommentController::class, 'storeCommentToProduct'])->middleware('auth:api');
    //Likes - Products
    Route::post('/product/{product_id}/like', [LikeController::class, 'like'])->middleware('auth:api');
    Route::post('/product/{product_id}/dislike', [LikeController::class, 'dislike'])->middleware('auth:api');
});

Route::get('/ISO_countries', [ISOCountriesController::class, 'getISOCountries']);
Route::get('categories', [CategoryController::class, 'getCategories']);
Route::get('categories/get-one/{id}', [CategoryController::class, 'categoriesGetOne']);
Route::get('/products/limit/{limit}', [ProductController::class, 'getProductsLimit']);
Route::get('products/{id}/get-one', [ProductController::class, 'productGetOne']);
Route::post('products/filter', [ProductController::class, 'filterProducts']);
//Comments - Products
Route::get('/comments/{id}', [CommentController::class, 'getCommentOfProduct']);
//Likes - Products
Route::get('/product/{id}/likes', [LikeController::class, 'getLikes']);
Route::get('/product/{id}/dislikes', [LikeController::class, 'getDislikes']);

