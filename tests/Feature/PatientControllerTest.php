<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Support\Facades\Log;

class PatientControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_guest_cannot_access_patient_index()
    {
        $response = $this->getJson('/api/patients');
        $response->assertStatus(401); // Non autenticato
    }

    public function test_doctor_can_create_patient()
    {
        $user = User::factory()->create();
        $user->assignRole('doctor');
        $this->actingAs($user);

        $response = $this->postJson('/api/patients', [
            'national_id' => 'fiscal_code_example',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('patients', ['national_id' => 'fiscal_code_example']);
    }

    public function test_doctor_can_update_patient()
    {
        $user = User::factory()->create();
        $user->assignRole('doctor');
        $this->actingAs($user);

        $patient = Patient::factory()->create();

        $response = $this->putJson("/api/patients/{$patient->id}", [
            'first_name' => 'Jane',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'first_name' => 'Jane']);
    }

    public function test_doctor_can_delete_patient()
    {
        $user = User::factory()->create();
        $user->assignRole('doctor');
        $this->actingAs($user);

        $patient = Patient::factory()->create();

        $response = $this->deleteJson("/api/patients/{$patient->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
    }

    // Altri test per casi specifici
}