<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Services\PatientService;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->middleware(['auth:sanctum', 'role:admin|doctor|nurse']);
        $this->patientService = $patientService;
    }
    
    // Visualizza tutti i pazienti
    public function index()
    {
        $this->authorize('viewAny', Patient::class);
        return Patient::all();
    }

    // Visualizza un singolo paziente
    public function show(Patient $patient)
    {
        $this->authorize('view', $patient);
        return $patient;
    }

    // Crea un nuovo paziente
    public function store(Request $request)
    {
        $this->authorize('create', Patient::class);

        $validated = $request->validate([
            'national_id' => 'required|string|unique:patients',
        ]);

        //Dato il codice fiscale, salva i dati del paziente
        try {
            $patient = $this->patientService->savePatientData($validated['national_id']);
            return response()->json($patient, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Aggiorna i dettagli di un paziente
    public function update(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);

        $validated = $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'birth_date' => 'date',
            'gender' => 'nullable|string',
            'national_id' => 'string|unique:patients,national_id,' . $patient->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $patient->update($validated);
        return response()->json($patient);
    }

    // Cancella un paziente
    public function destroy(Patient $patient)
    {
        $this->authorize('delete', $patient);
        $patient->delete();
        return response()->json(null, 204);
    }
}
