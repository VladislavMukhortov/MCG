<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization, Policyable;

    public function viewPage(User $user, Contact $contact)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_REPRESENTATIVE, User::ROLE_MANAGER);
    }

    public function viewAny(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_REPRESENTATIVE, User::ROLE_MANAGER);
    }

    public function view(User $user, Contact $contact)
    {
        return $this->viewAny($user);
    }

    public function create(User $user)
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Contact $contact)
    {
        return $this->viewAny($user);
    }

    public function delete(User $user, Contact $contact)
    {
        return $this->viewAny($user);
    }
}
