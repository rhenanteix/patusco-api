<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::with('animal', 'doctor')
            ->filterByDate($request->date)
            ->filterByAnimal($request->animal_id)
            ->get();

        return Inertia::render('Appointments/Index', [
            'appointments' => $appointments
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'person_name' => 'required|string',
            'email' => 'required|email',
            'animal_name' => 'required|string',
            'animal_id' => 'required|exists:animals,id',
            'animal_age' => 'required|integer|min:0',
            'symptoms' => 'required|string',
            'appointment_date' => 'required|date',
            'appointment_period' => 'required|in:morning,afternoon',
        ]);
    
        Appointment::create($data);
    
        return redirect()->back()->with('success', 'Marcação criada com sucesso!');
    }
    
}

