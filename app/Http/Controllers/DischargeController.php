<?php

namespace App\Http\Controllers;

use App\Models\Discharge;
use Illuminate\Http\Request;

class DischargeController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Discharge::class);
        return Discharge::all();
    }

    public function show(Discharge $discharge)
    {
        $this->authorize('view', $discharge);
        return $discharge;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Discharge::class);
        $validated = $request->validate([
            'admission_id' => 'required|exists:admissions,id',
            'discharge_date' => 'required|date',
            'discharge_notes' => 'nullable|string',
        ]);
        $discharge = Discharge::create($validated);
        return response()->json($discharge, 201);
    }

    public function update(Request $request, Discharge $discharge)
    {
        $this->authorize('update', $discharge);
        $validated = $request->validate([
            'discharge_date' => 'date',
            'discharge_notes' => 'nullable|string',
        ]);
        $discharge->update($validated);
        return response()->json($discharge);
    }

    public function destroy(Discharge $discharge)
    {
        $this->authorize('delete', $discharge);
        $discharge->delete();
        return response()->json(null, 204);
    }
}
