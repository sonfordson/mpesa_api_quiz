<?php

namespace App\Providers;

use App\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\PassportServiceProvider;


class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Schema::defaultStringLength(191);
    }


    public function register()
    {
        // Passport::ignoreMigrations;
    }
}
