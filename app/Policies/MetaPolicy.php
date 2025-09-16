<?php

namespace App\Policies;

use App\Models\Recursos\Metas;
use App\Models\Personas\User;
use Illuminate\Auth\Access\Response;

class MetaPolicy
{
    public function use(User $user, Metas $meta): bool
    {
        return $meta->usuario->is($user);
    }
}
