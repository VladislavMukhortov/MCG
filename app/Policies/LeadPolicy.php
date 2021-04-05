<?php

namespace App\Policies;

use App\Models\Leads;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
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

    public function viewAnyForLead(User $user)
    {
        return $user->is_lead;
    }

    public function view(User $user, Leads $lead)
    {
        return $this->viewPage($user);
    }

    public function create(User $user)
    {
        return $this->viewPage($user);
    }

    public function update(User $user, Leads $lead)
    {
        return $this->viewPage($user);
    }

    public function delete(User $user, Leads $lead)
    {
        return $this->viewPage($user);
    }
}
