<?php

namespace App\Policies;

use App\Models\Request;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization, Policyable;

    public function viewPage(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_REPRESENTATIVE, User::ROLE_MANAGER);
    }

    public function viewAny(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_REPRESENTATIVE, User::ROLE_MANAGER);
    }

    public function view(User $user, Request $request)
    {
        return $this->viewAny($user);
    }

    public function create(User $user)
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Request $request)
    {
        return $this->viewAny($user);
    }

    public function delete(User $user, Request $request)
    {
        return $this->viewAny($user);
    }

}
