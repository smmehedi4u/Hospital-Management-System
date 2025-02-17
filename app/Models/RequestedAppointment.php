<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestedAppointment extends Model
{
    use HasFactory,softDeletes;
    protected $fillable=[
        'name',
        'email',
        'phone',
        'employee_id',
        'message',
        'address',
        'stime',
    ];

    public function employ()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
