<?php

namespace App\Policies\Traits;

use App\Models\User;

trait Policyable
{
    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ( !$user->is_active ) return false;
        if ( $user->is_admin ) return true;
    }
}