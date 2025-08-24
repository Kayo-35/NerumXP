<?php

namespace App\Providers;

use App\Models\Personas\User;
use App\Models\Recursos\RegistroFixo;
use Illuminate\Support\Facades\Gate;
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
        Blade::component(
            "registro.card",
            \App\View\Components\Registro\Card::class,
        );
        Blade::component("components.registro.form", "registro.form");

        //Autenticação e autorização
        Gate::define("access-registroFixo", function (
            User $user,
            RegistroFixo $registroFixo,
        ) {
            /*  A linha abaixo, por exemplo, permitiria apenas que um usuário dono de um recurso e
            detentor de assinatura nivel ouro, 3, acessasse um recurso
            $logic = $registroFixo->usuario()->is($user) && $user->cd_assinatura == 3;
            */
            $logic = $registroFixo->usuario()->is($user);
            return $logic;
        });
    }
}
