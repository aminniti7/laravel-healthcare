<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Patient;

class PatientPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('view_patients');
    }

    public function view(User $user, Patient $patient)
    {
        return $user->can('view_patients');
    }

    public function create(User $user)
    {
        return $user->can('manage_patients');
    }

    public function update(User $user, Patient $patient)
    {
        return $user->can('manage_patients');
    }

    public function delete(User $user, Patient $patient)
    {
        return $user->can('manage_patients');
    }
}
