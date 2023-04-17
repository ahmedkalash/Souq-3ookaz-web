<?php

use App\Http\Controllers\Web\Customer\Auth\LoginController;
use App\Http\Controllers\Web\Customer\Auth\LogoutController;
use App\Http\Controllers\Web\Customer\Auth\RegisterController;
use App\Http\Controllers\Web\Customer\CartItemController;
use App\Http\Controllers\Web\Customer\HomePageController;
use App\Http\Controllers\Web\Customer\ProductController;
use App\Http\Controllers\Web\TestController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


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

Route::get('/', [HomePageController::class,'showHomePage'])->name('home.show');

Route::group(['middleware'=>RedirectIfAuthenticated::class],function (){

    Route::group(['prefix'=>'register','controller'=>RegisterController::class],function (){
        Route::get('/', 'showRegisterPage')->name('register.show') ;
        Route::post('/','create')->name('register.create') ;
    });

     Route::group(['prefix'=>'login','controller'=>LoginController::class],function (){
         Route::get('/', 'showLoginPage')->name('login.show') ;
         Route::post('/', 'login')->name('login') ;
    });

});


Route::group(['middleware'=>'auth'], function (){
    Route::get('/logout',[LogoutController::class, 'logout'])->name('logout');
}) ;



// products
Route::controller(ProductController::class)
    ->group(function (){
        Route::get('/products/{product_id}','showProductById')
            ->where('product_id', '[0-9]+')->name('product.showByID') ;
        Route::get('/products/{product_slug}', 'showProductBySlug')
            ->name('product.showBySlug');

        Route::get('/{category_id}/products', 'showProductsByCategoryID')
            ->where('category_id', '[0-9]+')->name('product.showByCategoryID');
        Route::get('/{category_slug}/products','showProductsByCategorySlug')
            ->name('product.showByCategorySlug');

        Route::get('/products', 'allProducts');
    });



// shopping cart
Route::group([
    'middleware'=>'auth',
    'controller'=>CartItemController::class,
    'prefix'=>'cart'
], function (){
    Route::post('/','addProduct')->name('cart.addProduct');

    //--------------
    Route::get('/','getCart')->name('cart.show');
    Route::delete('/','emptyCart');
    Route::delete('/product/{product_id}','deleteItem');
    Route::delete('/product/{product_id}/decrement', 'decrementItemCount');
});




Route::get('test',[TestController::class, 'index']);
