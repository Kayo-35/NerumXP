<?php

namespace App\Policies;

use App\Models\Recursos\Metas;
use App\Models\Personas\User;

class MetaPolicy
{
    public function use(User $user, Metas $meta): bool
    {
        return $meta->usuario->is($user);
    }
    public function access(User $user): bool {
        return $user->cd_assinatura > 1;
    }
}
