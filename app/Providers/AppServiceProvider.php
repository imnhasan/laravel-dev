<?php

namespace App\Providers;

use Illuminate\Support\Str;
use App\MacroMixin\MacroMixin;
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
        // Str::mixin(new MacroMixin());
        Paginator::useBootstrap();
    }
}
