<?php

use App\Http\Controllers\Web\Admin\Auth\AuthController;
use App\Http\Controllers\Web\Admin\HomePageController;
use App\Http\Controllers\Web\Admin\ProfileController;
use App\Http\Controllers\Web\TestController;
use App\Http\Middleware\Admin\RedirctIfAdmin;
use App\Http\Middleware\LogoutFromCurrentRole;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\Web\Admin\ProductController;



Route::get('/dashboard', [HomePageController::class,'showHomePage'])
    ->name('admin.home.show');

Route::group(['middleware'=>RedirectIfAuthenticated::class],function (){
     Route::withoutMiddleware(['auth','admin'])
         ->prefix('login')
         ->controller(AuthController::class)
         ->group(function (){
         Route::get('/', 'showLoginPage')->name('admin.login.show');
         Route::post('/', 'login')->name('admin.login')
             ->middleware(LogoutFromCurrentRole::class);
    });

});

Route::post('/logout',[AuthController::class, 'logout'])->name('admin.logout');

Route::controller(ProfileController::class)
    ->group(function (){
        Route::get('/profile','showProfile')->name('admin.profile.show');
        Route::post('/profile', 'updateProfile')->name('admin.profile.update');
    });

Route::controller(\App\Http\Controllers\Web\Admin\ProductController::class)
    ->group(function (){
        Route::get('/products/products-list','showProductList')->name('admin.productList.show');
        Route::delete('/products/{product_id}','deleteProduct')->name('admin.product.delete');
        Route::get('/products/add-product','showAddProduct')->name('admin.product.add.show');
        Route::post('/products','addProduct')->name('admin.product.add.store');
        Route::get('/products/product-review','showProductReview')->name('admin.product.review.show');
        Route::delete('/products/product-review/{product_review_id}','deleteProductReview')->name('admin.product.review.delete');
    });

Route::controller(\App\Http\Controllers\Web\Admin\CategoryController::class)
    ->group(function (){
        Route::get('/category/category-list','showCategoryList')->name('admin.categoryList.show');
        Route::delete('/category/{category_id}','deleteCategory')->name('admin.category.delete');
        Route::get('/category/add-category','showAddCategory')->name('admin.category.add.show');
        Route::post('/category/add-category','AddCategory')->name('admin.category.add.store');
    });





Route::get('test',[TestController::class, 'index']);


