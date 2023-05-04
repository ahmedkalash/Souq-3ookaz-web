<?php

namespace App\Providers;

use App\Http\Interfaces\Web as WebInterfaces;
use App\Http\Repositories\Web as WebRepositories;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->bindWeb();;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function bindWeb(){

        $this->bindAuth();
        $this->bindHomePage();
        $this->bindCategory();
        $this->bindProduct();
        $this->bindCartItem();
    }

    public function bindAuth(){
        $this->app->bind(
            WebInterfaces\Customer\Auth\RegisterInterface::class,
            WebRepositories\Customer\Auth\RegisterRepository::class
        );
        $this->app->bind(
            WebInterfaces\Customer\Auth\LoginInterface::class,
            WebRepositories\Customer\Auth\LoginRepository::class
        );
        $this->app->bind(
            WebInterfaces\Customer\Auth\LogoutInterface::class,
            WebRepositories\Customer\Auth\LogoutRepository::class
        );
    }

    public function bindHomePage(){
        $this->app->bind(
            WebInterfaces\Customer\HomePageInterface::class,
            WebRepositories\Customer\HomePageRepository::class
        );
    }

    public function bindCategory(){
        $this->app->bind(
            WebInterfaces\Customer\CategoryInterface::class,
            WebRepositories\Customer\CategoryRepository::class
        );
    }
    public function bindProduct(){
        $this->app->bind(
            WebInterfaces\Customer\ProductInterface::class,
            WebRepositories\Customer\ProductRepository::class
        );
    }

    public function bindCartItem()
    {
         $this->app->bind(
            WebInterfaces\Customer\CartItemInterface::class,
            WebRepositories\Customer\CartItemRepository::class
        );
    }

}
