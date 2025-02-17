<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Birthreport extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'patient_id',
        'description',
        'employee_id',
        'gender',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
