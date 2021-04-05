<?php

namespace App\Policies;

use App\Models\GeneralContractors;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralContractorPolicy
{
    use HandlesAuthorization, Policyable;

    public function viewPage(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_MANAGER);
    }

    public function viewAny(User $user)
    {
        return $this->viewPage($user);
    }

    public function view(User $user, GeneralContractors $generalContractor)
    {
        return $this->viewAny($user);
    }

    public function create(User $user)
    {
        return $this->viewPage($user);
    }

    public function update(User $user, GeneralContractors $generalContractor)
    {
        return $this->viewPage($user);
    }

    public function delete(User $user, GeneralContractors $generalContractor)
    {
        return $this->viewPage($user);
    }
}
