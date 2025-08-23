<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //configs
        Paginator::useBootstrapFive();
        Blade::component('registro.card', \App\View\Components\Registro\Card::class);
        Blade::component('components.registro.form', 'registro.form');
    }
}
