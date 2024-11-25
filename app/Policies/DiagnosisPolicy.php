<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Diagnosis;

class DiagnosisPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('view_diagnoses');
    }

    public function view(User $user, Diagnosis $diagnosis)
    {
        return $user->can('view_diagnoses');
    }

    public function create(User $user)
    {
        return $user->can('manage_diagnoses');
    }

    public function update(User $user, Diagnosis $diagnosis)
    {
        return $user->can('manage_diagnoses');
    }

    public function delete(User $user, Diagnosis $diagnosis)
    {
        return $user->can('manage_diagnoses');
    }
}
