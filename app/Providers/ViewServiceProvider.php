<?php

namespace App\Providers;

use App\Http\Interfaces\Web\Customer\CartItemInterface;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Repositories\Web\Customer\CartItemRepository;
use App\Models\CartItem;
use App\View\ViewPath;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $categoryRepository= app(CategoryInterface::class);

        \View::share(
            ['categories' => $categoryRepository->getAllCategoriesHierarchy()]
        );


//        \View::composer( [ViewPath::MASTER,ViewPath::CHECK_OUT,  'customer-end.includes.header'], function (View $view) {
//            $cartItems = app(CartItemRepository::class)->getCart();
//            $view->with('cartItems', $cartItems['cartItems']);
//            $view->with('total_price', $cartItems['total_price']);
//         });

    }
}
