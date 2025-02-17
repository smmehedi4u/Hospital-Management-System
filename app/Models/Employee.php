<?php

namespace App\Models;

use App\Models\Operationreport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "email",
        "phone",
        "salary",
        "address",
        "qualification",
        "position",
        "status",
        "image",
    ];

    public function operationreport()
    {
        return $this->hasMany(Operationreport::class);
    }

    public function requestedAppointment()
    {
        return $this->hasMany(RequestedAppointment::class);
    }

}
