<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admission;

class AdmissionPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('view_admissions');
    }

    public function view(User $user, Admission $admission)
    {
        return $user->can('view_admissions');
    }

    public function create(User $user)
    {
        return $user->can('manage_admissions');
    }

    public function update(User $user, Admission $admission)
    {
        return $user->can('manage_admissions');
    }

    public function delete(User $user, Admission $admission)
    {
        return $user->can('manage_admissions');
    }
}
