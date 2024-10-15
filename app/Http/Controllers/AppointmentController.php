<?php

// app/Http/Controllers/AppointmentController.php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Listar todos os agendamentos
    public function index(Request $request)
    {
        // Filtrar por data e tipo de animal, se fornecidos
        $appointments = Appointment::when($request->date, function ($query) use ($request) {
            return $query->whereDate('appointment_date', $request->date);
        })->when($request->animal_type, function ($query) use ($request) {
            return $query->where('animal_type', $request->animal_type);
        })->with('doctor')->get();

        return inertia('Appointments', ['appointments' => $appointments]);
    }

    // Criar agendamento
    public function store(Request $request)
    {
       // $request->validate([...]);
        Appointment::create($request->all());
        return redirect()->back()->with('success', 'Agendamento criado com sucesso!');
    }

    // Editar agendamento
    public function update(Request $request, Appointment $appointment)
    {
     //   $request->validate([...]); // regras de validação
        $appointment->update($request->all());
        return redirect()->back()->with('success', 'Agendamento atualizado com sucesso!');
    }

    // Excluir agendamento
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->back()->with('success', 'Agendamento excluído com sucesso!');
    }

    // Listar agendamentos atribuídos a um médico
    public function doctorAppointments(Request $request)
    {
        $doctorId = auth()->id();
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $request->date) // filtrar por data
            ->get();
        
        return inertia('DoctorAppointments', ['appointments' => $appointments]);
    }
}

