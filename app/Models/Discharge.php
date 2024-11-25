<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discharge extends Model
{
    use HasFactory;

    protected $fillable = ['admission_id', 'discharge_date', 'discharge_notes'];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }
}
