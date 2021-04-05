<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ( !$user->is_active ) return false;
    }

    public function viewPage(User $user)
    {
        return $user->is_lead || $user->is_subcontractor;
    }

    public function viewAny(User $user)
    {
        return $user->is_lead || $user->is_subcontractor;
    }

}
