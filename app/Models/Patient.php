<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'birth_date', 'gender', 'national_id', 'phone', 'address'];
    
    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }

    public function therapies()
    {
        return $this->hasMany(Therapy::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
}
