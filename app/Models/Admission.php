<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'admission_date', 'admission_reason', 'room'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function discharge()
    {
        return $this->hasOne(Discharge::class);
    }
}
