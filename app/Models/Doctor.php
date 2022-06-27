<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty_id',
        'title_id',
        'bio',
    ];

    public function recrods()
    {
        return $this->hasMany( Record::class);
    }

    public function appointments()
    {
        return $this->hasMany( Appointment::class);
    }

    public function roles()
    {
        return $this->hasOne( Role::class);
    }

    public function title()
    {
        return $this->belongsTo( Title::class);
    }

    public function specialty()
    {
        return $this->belongsTo( Specialty::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
