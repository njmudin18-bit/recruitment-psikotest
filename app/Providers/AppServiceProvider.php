<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      // Bootstrap 5
      Paginator::useBootstrapFive();

      // Bootstrap 4
      Paginator::useBootstrapFour();

      // Bootstrap 4
      Paginator::useBootstrap();
    }
}
