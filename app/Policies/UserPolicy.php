<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;

class UserPolicy
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
        if ( $user->is_admin ) return true;
    }

    public function viewPage(User $authUser, User $user, string $pageName) //todo add menu items to trans and make usable here
    {
        switch (Str::of($pageName)->snake()->__toString()) {
            case 'call_center':
            case 'events':
            case 'email':
                return $authUser->isA(User::ROLE_ADMIN, User::ROLE_MANAGER, User::ROLE_REPRESENTATIVE);

            case 'admin_settings':
            case 'user_roles':
            case 'workers':
            case 'reports':
                return $authUser->isA(User::ROLE_ADMIN, User::ROLE_MANAGER);

            case 'documents':
                return $authUser->isA(User::ROLE_SUBCONTRACTOR, User::ROLE_LEAD);  //todo  || $user->is_lead

            case 'account_settings':
            case 'logout':
            case 'home':
                return true;

            default:
                return false;
        }
    }


    public function viewAny(User $authUser)
    {
        return $authUser->isA(User::ROLE_ADMIN, User::ROLE_MANAGER);
    }

    public function view(User $authUser, User $user)
    {
        return $this->viewAny($authUser);
    }

    public function create(User $authUser)
    {
        return $this->viewAny($authUser);
    }

    public function update(User $authUser, User $user)
    {
        return $this->managerNotAdmin($authUser, $user);
    }

    public function delete(User $authUser, User $user)
    {
        return $this->managerNotAdmin($authUser, $user);
    }

    public function viewAnyWorker(User $authUser)
    {
        return $authUser->isA(User::ROLE_ADMIN, User::ROLE_MANAGER);
    }

    public function viewWorker(User $authUser, User $user)
    {
        return $this->viewAnyWorker($authUser);
    }

    public function createWorker(User $authUser)
    {
        return $this->viewAnyWorker($authUser);
    }

    public function updateWorker(User $authUser, User $user)
    {
        return $this->viewAnyWorker($user);
    }

    public function deleteWorker(User $authUser, User $user)
    {
        return $this->viewAnyWorker($user);
    }

    public function setNewPassword(User $authUser, User $user)
    {
        return $this->managerNotAdmin($authUser, $user);
    }

    public function assignRole(User $authUser, User $user, bool $isAdminRole)
    {
        return $this->managerNotAdmin($authUser, $user) && ($isAdminRole ? $authUser->is_admin : $this->update($authUser, $user));
    }

    protected function managerNotAdmin(User $authUser, User $user)
    {
        return $authUser->is_manager ? !$user->is_admin : $authUser->is_admin;
    }
}
