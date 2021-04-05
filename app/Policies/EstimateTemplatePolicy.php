<?php

namespace App\Policies;

use App\Models\EstimateTemplateRepository;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstimateTemplatePolicy
{
    use HandlesAuthorization, Policyable;

    public function viewPage(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_REPRESENTATIVE, User::ROLE_MANAGER);
    }

    public function viewAny(User $user)
    {
        return $this->viewPage($user);
    }

    public function view(User $user, EstimateTemplateRepository $estimateTemplate)
    {
        return $this->viewPage($user);
    }

    public function create(User $user)
    {
        return $this->viewPage($user);
    }

    public function update(User $user, EstimateTemplateRepository $estimateTemplate)
    {
        return $this->viewPage($user);
    }

    public function delete(User $user, EstimateTemplateRepository $estimateTemplate)
    {
        return $this->viewPage($user);
    }
}
