<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCheckup extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'description',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
