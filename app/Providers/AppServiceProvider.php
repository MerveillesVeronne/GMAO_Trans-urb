<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Barryvdh\DomPDF\Facade\Pdf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('pdf', function ($app) {
            return new Pdf();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix MySQL key length issue
        Schema::defaultStringLength(191);
    }
}
