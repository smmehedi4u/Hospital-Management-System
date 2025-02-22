<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable=[
        'patient_id',
        'amount',
        'payed',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
