<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    public function destroy(User $currentUser, Status $status)
    {
        return $currentUser->id === $status->user_id;
    }
}
