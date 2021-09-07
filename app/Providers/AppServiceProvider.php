<?php

namespace App\Providers;

use App\Domain\Repository\ContactRepository;
use App\Domain\Repository\Contract\ContactRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       $this->app->bind(
           ContactRepositoryInterface::class, ContactRepository::class
       );
    }
}
