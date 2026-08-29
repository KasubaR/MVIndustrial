<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // Older MySQL/MariaDB configs (common on shared hosting) cap index
        // key length below what a utf8mb4 varchar(255) unique/primary key needs.
        Schema::defaultStringLength(191);
    }
}
