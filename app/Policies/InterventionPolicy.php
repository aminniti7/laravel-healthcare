<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Intervention;

class InterventionPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('view_interventions');
    }

    public function view(User $user, Intervention $intervention)
    {
        return $user->can('view_interventions');
    }

    public function create(User $user)
    {
        return $user->can('manage_interventions');
    }

    public function update(User $user, Intervention $intervention)
    {
        return $user->can('manage_interventions');
    }

    public function delete(User $user, Intervention $intervention)
    {
        return $user->can('manage_interventions');
    }
}
