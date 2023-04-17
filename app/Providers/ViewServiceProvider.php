<?php

namespace App\Providers;

use App\Http\Interfaces\Web\Customer\CartItemInterface;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use Illuminate\Support\ServiceProvider;

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

    }
}
