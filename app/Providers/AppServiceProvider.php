<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\book;
use App\OrderDetail;
use App\Observers\bookObserver;
use App\Observers\OrderDetailObserver;

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
        book::observe(bookObserver::class);
    }
}
