<?php

namespace App\Providers;

use App\Models\Personas\User;
use App\Models\Recursos\Registro;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Policies\RegistroPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $policies = [
        Registro::class => RegistroPolicy::class,
    ];
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
        Blade::component(
            "registro.card",
            \App\View\Components\Registro\Card::class,
        );
        Blade::component("components.registro.form", "registro.form");
    }
}
