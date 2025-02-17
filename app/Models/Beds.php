<?php

namespace App\Models;

use App\Models\Rooms;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beds extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'patient_id',
        // 'status',
        "alloted_time",
        "discharge_time",
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
