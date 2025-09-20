<?php

namespace App\Policies;

use App\Models\Recursos\Metas;
use App\Models\Personas\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class MetaPolicy
{
    public function use(User $user, Metas $meta): bool
    {
        return $meta->usuario->is($user);
    }
    public function access(User $user): bool {
        return Auth::user()->cd_assinatura > 1;
    }
}
