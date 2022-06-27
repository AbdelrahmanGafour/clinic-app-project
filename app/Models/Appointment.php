<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'price',
        'appointment_type',
        'date',
        'start_time',
        'duration',
        'status_id',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function recrod()
    {
        return $this->hasOne( Record::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
