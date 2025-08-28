<?php

namespace App\Policies;

use App\Models\Recursos\Registro;
use App\Models\Personas\User;
use Illuminate\Auth\Access\Response;

class RegistroPolicy
{
    public function use(User $user, Registro $registro): bool
    {
        return $registro->usuario->is($user);
    }
}
