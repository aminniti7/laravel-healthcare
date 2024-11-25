<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Patient::class => PatientPolicy::class,
        Admission::class => AdmissionPolicy::class,
        Therapy::class => TherapyPolicy::class,
        Diagnosis::class => DiagnosisPolicy::class,
        Intervention::class => InterventionPolicy::class,
        Discharge::class => DischargePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('manage-patients', function (User $user) {
            return $user->hasRole('admin') || $user->can('manage_patients');
        });
    }
}
