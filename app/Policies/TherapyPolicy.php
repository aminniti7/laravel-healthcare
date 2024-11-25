<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Therapy;

class TherapyPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('view_therapies');
    }

    public function view(User $user, Therapy $therapy)
    {
        return $user->can('view_therapies');
    }

    public function create(User $user)
    {
        return $user->can('manage_therapies');
    }

    public function update(User $user, Therapy $therapy)
    {
        return $user->can('manage_therapies');
    }

    public function delete(User $user, Therapy $therapy)
    {
        return $user->can('manage_therapies');
    }
}
