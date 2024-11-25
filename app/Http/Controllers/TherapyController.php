<?php

namespace App\Http\Controllers;

use App\Models\Therapy;
use Illuminate\Http\Request;

class TherapyController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Therapy::class);
        return Therapy::all();
    }

    public function show(Therapy $therapy)
    {
        $this->authorize('view', $therapy);
        return $therapy;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Therapy::class);
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'admission_id' => 'nullable|exists:admissions,id',
            'therapy_name' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);
        $therapy = Therapy::create($validated);
        return response()->json($therapy, 201);
    }

    public function update(Request $request, Therapy $therapy)
    {
        $this->authorize('update', $therapy);
        $validated = $request->validate([
            'therapy_name' => 'string',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);
        $therapy->update($validated);
        return response()->json($therapy);
    }

    public function destroy(Therapy $therapy)
    {
        $this->authorize('delete', $therapy);
        $therapy->delete();
        return response()->json(null, 204);
    }
}
