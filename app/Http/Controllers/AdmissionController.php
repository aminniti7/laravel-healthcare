<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Admission::class);
        return Admission::all();
    }

    public function show(Admission $admission)
    {
        $this->authorize('view', $admission);
        return $admission;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Admission::class);
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'admission_date' => 'required|date',
            'admission_reason' => 'required|string',
            'room' => 'nullable|string',
        ]);
        $admission = Admission::create($validated);
        return response()->json($admission, 201);
    }

    public function update(Request $request, Admission $admission)
    {
        $this->authorize('update', $admission);
        $validated = $request->validate([
            'admission_date' => 'date',
            'admission_reason' => 'string',
            'room' => 'nullable|string',
        ]);
        $admission->update($validated);
        return response()->json($admission);
    }

    public function destroy(Admission $admission)
    {
        $this->authorize('delete', $admission);
        $admission->delete();
        return response()->json(null, 204);
    }
}
