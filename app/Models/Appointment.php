<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * Get the user of this appointment
     */

    public function patient()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * Get the symptoms of this appointment
     */
    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'appointment_symptom', 'appointment_id', 'symptom_id');
    }

    



}
