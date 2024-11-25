<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Intervention::class);
        return Intervention::all();
    }

    public function show(Intervention $intervention)
    {
        $this->authorize('view', $intervention);
        return $intervention;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Intervention::class);
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'admission_id' => 'nullable|exists:admissions,id',
            'intervention_name' => 'required|string',
            'description' => 'nullable|string',
            'intervention_date' => 'nullable|date',
        ]);
        $intervention = Intervention::create($validated);
        return response()->json($intervention, 201);
    }

    public function update(Request $request, Intervention $intervention)
    {
        $this->authorize('update', $intervention);
        $validated = $request->validate([
            'intervention_name' => 'string',
            'description' => 'nullable|string',
            'intervention_date' => 'nullable|date',
        ]);
        $intervention->update($validated);
        return response()->json($intervention);
    }

    public function destroy(Intervention $intervention)
    {
        $this->authorize('delete', $intervention);
        $intervention->delete();
        return response()->json(null, 204);
    }
}
