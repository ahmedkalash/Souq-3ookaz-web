<?php

namespace App\Providers;
use App\Http\Interfaces\Web as WebInterfaces;
use App\Http\Repositories\Web as WebRepositories;
use Illuminate\Support\ServiceProvider;

class AdminRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->bindWeb();

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

    }

    public function bindAuth(){
        $this->app->bind(
            WebInterfaces\Admin\Auth\AuthInterface::class,
            WebRepositories\Admin\Auth\AuthRepository::class
        );

    }
}
