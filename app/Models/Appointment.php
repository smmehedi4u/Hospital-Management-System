<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable=[
        'patient_id',
        'doctor_id',
        'intime',
        'outtime',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function checkups(){
        return $this->hasMany(PatientCheckup::class);
    }


}
