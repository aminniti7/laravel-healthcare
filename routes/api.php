<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\TherapyController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\DischargeController;
use App\Models\User;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/associate-role/{id}', function ($id) {
    $user = User::find($id);
    $user->assignRole('admin');
    return response()->json(['message' => 'Role associated successfully']);
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::resource('admissions', AdmissionController::class);
    Route::resource('therapies', TherapyController::class);
    Route::resource('diagnoses', DiagnosisController::class);
    Route::resource('interventions', InterventionController::class);
    Route::resource('discharges', DischargeController::class);
});

