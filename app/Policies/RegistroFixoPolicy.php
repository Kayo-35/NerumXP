<?php

namespace App\Policies;

use App\Models\Recursos\RegistroFixo;
use App\Models\Personas\User;
use Illuminate\Auth\Access\Response;

class RegistroFixoPolicy
{
    public function use(User $user, RegistroFixo $registroFixo) : bool
    {
        return $registroFixo->usuario->is($user);
    }
}
