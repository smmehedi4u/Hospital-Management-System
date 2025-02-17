<?php

namespace App\Http\Livewire\Admins;

use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use Livewire\Component;

class Appiontment extends Component
{

    public $patient;
    public $nurse;
    public $doctor;
    public $start_timeee;
    public $endtime;

    public $edit_appointment_id;
    public $button_text = "Add New Appointment";



    public function add_appointment()
    {
        if ($this->edit_appointment_id) {

            $this->update($this->edit_appointment_id);

        }else{
            $this->validate([
                'patient' => 'required|numeric',
                'doctor' => 'required|numeric',
                'nurse' => 'required|numeric',
                ]);
                Appointment::create([
                'patient_id'         => $this->patient,
                'nurse_id'           => $this->nurse,
                'doctor_id'         => $this->doctor,
                'intime ' => $this->start_timeee,
                'outtime ' => $this->endtime,
            ]);
            //unset variables
            $this->patient="";
            $this->doctor="";
            $this->nurse="";
            $this->start_timeee="";
            $this->endtime="";
            session()->flash('message', 'Appointment Created successfully.');
        }

    }

     public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->edit_appointment_id = $id;

        $this->patient = $appointment->patient_id;
        $this->doctor = $appointment->doctor_id;
        $this->nurse = $appointment->nurse_id;
        $this->start_timeee = $appointment->intime;
        $this->endtime = $appointment->outtime;

        $this->button_text="Update Appointment";
    }
    public function update($id)
    {
        $this->validate([
                'patient' => 'required|numeric',
                'doctor' => 'required|numeric',
                'nurse' => 'required|numeric',
            ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->patient_id = $this->patient;
        $appointment->doctor_id = $this->doctor;
        $appointment->nurse_id = $this->nurse;
        $appointment->intime = $this->start_timeee;
        $appointment->outtime = $this->endtime;

        $appointment->save();

        $this->patient="";
        $this->doctor="";
        $this->nurse="";
        $this->start_timeee="";
        $this->endtime="";

        session()->flash('message', 'Appointment Updated Successfully.');

        $this->button_text = "Add New Appointment";

}

     public function delete($id)
    {
        Appointment::find($id)->delete();
        session()->flash('message', 'Appointment Deleted Successfully.');
    }


    public function render()
    {
        return view('livewire.admins.appiontment',[
            'patients'=> Patient::all(),
            'doctors'=> Employee::all(),
            'appointments'=> Appointment::all(),
        ])->layout('admins.layouts.app');
    }
}
