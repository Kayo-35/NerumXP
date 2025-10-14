<?php

namespace App\Providers;

use App\Models\Recursos\Metas;
use Illuminate\Support\Facades\Gate;
use App\Models\Recursos\Registro;
use App\Policies\MetaPolicy;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Policies\RegistroPolicy;

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
        Blade::component("components.registro.form", "registro.form");
        Gate::policy(Metas::class, MetaPolicy::class);
        Gate::policy(Registro::class,RegistroPolicy::class);
    }
}
