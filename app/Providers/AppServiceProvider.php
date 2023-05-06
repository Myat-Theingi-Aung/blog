<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Category;
use App\Observers\UserObserver;
use App\Observers\CategoryObserver;
use Illuminate\Pagination\Paginator;
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
        // Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        Category::observe(CategoryObserver::class);
        User::observe(UserObserver::class);
    }
}
