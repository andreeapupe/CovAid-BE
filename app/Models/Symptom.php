<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;

    /**
     * Get the appointments of this symptom
     */
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_symptom', 'symptom_id', 'appointment_id');
    }
}
