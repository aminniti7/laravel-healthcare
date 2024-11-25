<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\Patient;
use robertogallea\LaravelCodiceFiscale\CodiceFiscale;
use Illuminate\Support\Facades\Http;

class PatientService
{
    protected $client;

    public function __construct()
    {
    }

    public function savePatientData($codiceFiscale)
    {
        $cf = new CodiceFiscale();

        $parsedData = $cf->parse($codiceFiscale);

        $patient = Patient::create([
            'first_name' => $parsedData['first_name'] ?? null,
            'last_name' => $parsedData['last_name'] ?? null,
            'birth_date' => $parsedData['birthdate'] ?? null,
            'gender' => $parsedData['gender'] ?? null,
            'national_id' => $codiceFiscale,
        ]);

        return $patient;
    }
}
