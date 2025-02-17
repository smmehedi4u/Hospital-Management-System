<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operationreport extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        "patient_id",
        "description",
        "employee_id",
        "status",
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function employ()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
