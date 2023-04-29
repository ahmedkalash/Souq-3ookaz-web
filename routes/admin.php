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

Route::get('/profile',[ProfileController::class, 'showProfile'])->name('admin.profile.show');
Route::post('/profile',[ProfileController::class, 'updateProfile'])->name('admin.profile.update');






//
//
//
//// products
//Route::controller(ProductController::class)
//    ->group(function (){
//        Route::get('/products/{product_id}','showProductById')
//            ->where('product_id', '[0-9]+')->name('product.showByID') ;
//        Route::get('/products/{product_slug}', 'showProductBySlug')
//            ->name('product.showBySlug');
//
//        Route::get('/{category_id}/products', 'showProductsByCategoryID')
//            ->where('category_id', '[0-9]+')->name('product.showByCategoryID');
//        Route::get('/{category_slug}/products','showProductsByCategorySlug')
//            ->name('product.showByCategorySlug');
//
//        Route::get('/products', 'allProducts')->name('product.showAll');
//    });
//
//
//
//// shopping cart
//Route::group([
//    'middleware'=>'auth',
//    'controller'=>CartItemController::class,
//    'prefix'=>'cart'
//], function (){
//    Route::post('/','addProduct')->name('cart.addProduct');
//    Route::get('/','getCart')->name('cart.show');
//    Route::delete('/','emptyCart')->name('cart.empty');
//    Route::delete('/product/{product_id}','deleteItem')->name('cart.deleteItem');
//    // need ajax
//    Route::delete('/product/{product_id}/decrement', 'decrementItemCount');
//});




Route::get('test',[TestController::class, 'index']);



