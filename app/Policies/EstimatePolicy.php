<?php

namespace App\Policies;

use App\Models\EstimateRepository;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstimatePolicy
{
    use HandlesAuthorization, Policyable;

    public function viewPage(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_REPRESENTATIVE, User::ROLE_MANAGER,
            User::ROLE_GENERAL_CONTRACTOR, User::ROLE_LEAD); //todo ||  $user->is_lead
    }

    public function viewAny(User $user)
    {
        return $this->viewPage($user);
    }

    public function view(User $user, EstimateRepository $estimate)
    {
        return $this->viewPage($user);
    }

    public function create(User $user)
    {
        return $this->viewPage($user);
    }

    public function update(User $user, EstimateRepository $estimate)
    {
        return $this->viewPage($user);
    }

    public function delete(User $user, EstimateRepository $estimate)
    {
        return $this->viewPage($user);
    }

    public function viewLineItems(User $user, EstimateRepository $estimate)
    {
        return $this->viewPage($user);
    }


}
