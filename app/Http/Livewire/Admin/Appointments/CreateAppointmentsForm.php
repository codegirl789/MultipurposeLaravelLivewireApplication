<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Livewire\Component;

class CreateAppointmentsForm extends Component
{
    public $state = [];

    public function createAppointment()
    {
        $this->state['status'] = 'open';
        Appointment::create($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully']);
    }

    public function render()
    {
        $clients = Client::latest()->get();
        return view('livewire.admin.appointments.create-appointments-form', [
            'clients' => $clients
        ]);
    }
}
