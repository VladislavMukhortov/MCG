<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use App\Policies\Traits\Policyable;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
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
        return $user->isA(User::ROLE_ADMIN, User::ROLE_REPRESENTATIVE, User::ROLE_MANAGER,
            User::ROLE_SUBCONTRACTOR, User::ROLE_LEAD); //todo  || $user->is_lead
    }

    public function viewAny(User $user)
    {
        return $user->isA(User::ROLE_ADMIN, User::ROLE_MANAGER, User::ROLE_REPRESENTATIVE) || $user->is_lead;
    }

    public function viewLead(User $user)
    {
        return $user->is_lead;
    }

    public function view(User $user, Question $question)
    {
        return $this->viewPage($user) && ($this->isOwn($user, $question) || $this->isOwnLead($user, $question));
    }

    public function create(User $user)
    {
        return $this->viewPage($user);
    }

    public function update(User $user, Question $question)
    {
        return $user->isA(User::ROLE_MANAGER, User::ROLE_ADMIN) || $this->isOwn($user, $question);
    }

    public function delete(User $user, Question $question)
    {
        return $this->viewPage($user);
    }

    public function changeStatus(User $user, Question $question)
    {
        return $this->isOwn($user, $question);
    }

    public function isOwn(User $user, Question $question)
    {
        return $user->id === $question->author_id;
    }

    public function isOwnLead(User $user, Question $question)
    {
        return !is_null($user->lead) ? ($user->lead->id === $question->lead_id) : false;
    }

}
