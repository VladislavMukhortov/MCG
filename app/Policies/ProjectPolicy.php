<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization, Policyable;

    public function viewPage(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_MANAGER, User::ROLE_SUBCONTRACTOR,
            User::ROLE_GENERAL_CONTRACTOR, User::ROLE_LEAD, User::ROLE_WORKER);  //todo  || $user->is_lead
    }

    public function viewAny(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_MANAGER);
    }

    public function viewAnyLead(User $user)
    {
        return $user->is_lead;
    }

    public function view(User $user, Project $project)
    {
        return $this->viewAny($user) || $this->leadOwn($user, $project);
    }

    public function create(User $user)
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Project $project)
    {
        return $this->viewAny($user);
    }

    public function delete(User $user, Project $project)
    {
        return $user->id === $project->author_id;
    }

    public function storePayment(User $user, Project $project) //todo
    {
        return $this->viewAny($user);
    }

    public function storePayout(User $user, Project $project) //todo
    {
        return $this->viewAny($user);
    }

    public function showTask(User $user, Project $project) //todo
    {
        return $this->viewAny($user);
    }

    public function leadOwn(User $user, Project $project)
    {
        return optional($user->lead)->id === $project->lead_id;
    }
}
