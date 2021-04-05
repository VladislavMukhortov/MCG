<?php

namespace App\Policies;

use App\Models\RemarkFile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RemarkFilePolicy
{
    use HandlesAuthorization;

    public function delete(User $user, RemarkFile $file)
    {
        return $this->isOwn($user, $file);
    }

    public function isOwn(User $user, RemarkFile $file)
    {
        return $user->id === $file->user_id;
    }
}
