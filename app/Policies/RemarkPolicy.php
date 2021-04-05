<?php

namespace App\Policies;

use App\Models\Remark;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RemarkPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Remark $remark)
    {
        return $this->isOwn($user, $remark);
    }

    public function isOwn(User $user, Remark $remark)
    {
        return $user->id === $remark->user_id;
    }
}
