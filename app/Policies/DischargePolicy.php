<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Discharge;

class DischargePolicy
{
    public function viewAny(User $user)
    {
        return $user->can('view_discharges');
    }

    public function view(User $user, Discharge $discharge)
    {
        return $user->can('view_discharges');
    }

    public function create(User $user)
    {
        return $user->can('manage_discharges');
    }

    public function update(User $user, Discharge $discharge)
    {
        return $user->can('manage_discharges');
    }

    public function delete(User $user, Discharge $discharge)
    {
        return $user->can('manage_discharges');
    }
}
