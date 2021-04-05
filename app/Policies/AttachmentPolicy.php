<?php

namespace App\Policies;

use App\Models\Attachments;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttachmentPolicy
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
        return $user->isA(User::ROLE_SUBCONTRACTOR) || $user->is_lead;
    }

    public function viewAny(User $user)
    {
        return $user->is_lead || $user->is_subcontractor;
    }

    public function view(User $user, Attachments $attachment)
    {
        return $this->viewAny($user);
    }

    public function create(User $user)
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Attachments $attachment)
    {
        return $this->viewAny($user);
    }

    public function delete(User $user, Attachments $attachment)
    {
        return $user->id === $attachment->uploaded_by && $this->viewAny($user);
    }
}
