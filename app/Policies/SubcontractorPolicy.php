<?php

namespace App\Policies;

use App\Models\SubContractors;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubcontractorPolicy
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

    public function viewHome(User $user)
    {
        return $user->is_subcontractor;
    }

    public function viewPage(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_MANAGER);
    }

    public function viewAny(User $user)
    {
        return $this->viewPage($user);
    }

    public function view(User $user, SubContractors $subContractor)
    {
        return $this->viewPage($user);
    }

    public function create(User $user)
    {
        return $this->viewPage($user);
    }

    public function update(User $user, SubContractors $subContractor)
    {
        return $this->viewPage($user);
    }

    public function delete(User $user, SubContractors $subContractor)
    {
        return $this->viewPage($user);
    }
}
