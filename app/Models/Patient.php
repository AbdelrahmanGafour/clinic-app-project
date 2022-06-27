<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address',
        'date_of_birth',
        'note',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
