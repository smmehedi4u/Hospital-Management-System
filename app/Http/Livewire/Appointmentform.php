<?php

namespace App\Http\Livewire;
use App\Models\Requestedappointment;
use Livewire\Component;

class Appointmentform extends Component
{
    public $name;
    public $email;
    public $phone;
    public $doctor;
    public $stime;
    public $address;
    public $message;

    public function store_requested_appointment()
    {
        $this->validate([
            'name' => 'required|',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'doctor' => 'required',
            'message' => 'required|max:550',
            'address' => 'required',
            'stime' => 'required',
            ]);

            Requestedappointment::create([
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'employee_id'       => $this->doctor,
            'message'      => $this->message,
            'address'       => $this->address,
            'stime'        => $this->stime,
        ]);

           //unset variables
           $this->name="";
           $this->email="";
           $this->stime="";
           $this->phone="";
           $this->doctor="";
           $this->address="";
           $this->message="";

           session()->flash('message', 'Your Appointment Added successfully.');
    }
    public function render()
    {
        return view('livewire.appointmentform');
    }
}
