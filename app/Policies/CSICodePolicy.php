<?php

namespace App\Policies;

use App\Models\CSICodes;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class CSICodePolicy
{
    use HandlesAuthorization, Policyable;

    public function viewPage(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_MANAGER);
    }

    public function viewAny(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_MANAGER);
    }

    public function view(User $user, CSICodes $CSICode)
    {
        return $this->viewPage($user);
    }

    public function create(User $user)
    {
        return $this->viewPage($user);
    }

    public function update(User $user, CSICodes $CSICode)
    {
        return $this->viewPage($user);
    }

    public function delete(User $user, CSICodes $CSICode)
    {
        return $this->viewPage($user);
    }
}
