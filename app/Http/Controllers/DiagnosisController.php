<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Diagnosis::class);
        return Diagnosis::all();
    }

    public function show(Diagnosis $diagnosis)
    {
        $this->authorize('view', $diagnosis);
        return $diagnosis;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Diagnosis::class);
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'admission_id' => 'nullable|exists:admissions,id',
            'diagnosis_name' => 'required|string',
            'details' => 'nullable|string',
        ]);
        $diagnosis = Diagnosis::create($validated);
        return response()->json($diagnosis, 201);
    }

    public function update(Request $request, Diagnosis $diagnosis)
    {
        $this->authorize('update', $diagnosis);
        $validated = $request->validate([
            'diagnosis_name' => 'string',
            'details' => 'nullable|string',
        ]);
        $diagnosis->update($validated);
        return response()->json($diagnosis);
    }

    public function destroy(Diagnosis $diagnosis)
    {
        $this->authorize('delete', $diagnosis);
        $diagnosis->delete();
        return response()->json(null, 204);
    }
}
