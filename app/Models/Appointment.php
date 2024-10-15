<?php

// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_name',
        'email',
        'animal_name',
        'animal_age',
        'symptoms',
        'appointment_date',
        'appointment_period',
        'doctor_id',
        'animal_type', // tipo de animal
    ];
}

