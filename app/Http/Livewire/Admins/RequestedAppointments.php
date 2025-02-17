<?php

namespace App\Http\Livewire\Admins;

use App\Models\Appointment;
use App\Models\Employee;
use Livewire\Component;
use App\Models\RequestedAppointment;
use App\Models\Patient;
use Livewire\WithPagination;

class RequestedAppointments extends Component
{
    use WithPagination;


    public $name;
    public $email;
    public $phone;
    public $doctor;
    public $message;
    public $address;
    public $stime;
    public $patient;
    public $start_time;
    public $end_time;
    public $_page;
    public $edit_appointment_id;
    public function mount()
    {
        $this->_page = 'index';
    }

    public function edit($id)
    {
        $appointment = RequestedAppointment::findOrFail($id);
        $this->edit_appointment_id = $id;

        $this->patient = $appointment->patient_id;
        $this->doctor = $appointment->employee_id;
        $this->start_time = $appointment->intime;
        $this->end_time = $appointment->outtime;
        $this->_page = "edit";
    }

    public function add_appointment()
    {
        if ($this->edit_appointment_id) {

            $this->update($this->edit_appointment_id);

        } else {
            $this->validate([
                "name" => "required",
                "email" => "required",
                "phone" => "required",
                "doctor" => "required",
                "message" => "required",
                "address" => "required",
                "stime" => "required",
            ]);
            RequestedAppointment::create([
                "name" => $this->name,
                "email" => $this->email,
                "phone" => $this->phone,
                "employee_id" => $this->doctor,
                "message" => $this->message,
                "address" => $this->address,
                "stime" => $this->stime,

            ]);
            //unset variables
            $this->name;
            $this->email;
            $this->phone;
            $this->doctor;
            $this->message;
            $this->address;
            $this->stime;
            $this->_page = "index";

            session()->flash('message', 'Appointment Created successfully.');
        }

    }
    public function update($edit_appointment_id)
    {
        $this->validate([
            'patient' => 'required|numeric',
            'doctor' => 'required|numeric',
        ]);

        $appointment = RequestedAppointment::findOrFail($edit_appointment_id);
        $appointment->patient_id = $this->patient;
        $appointment->employee_id = $this->doctor;
        $appointment->intime = $this->start_time;
        $appointment->outtime = $this->end_time;
        $appointment->save();

        //unset variables
        $this->patient = "";
        $this->doctor = "";
        $this->start_time = "";
        $this->end_time = "";
        $this->_page = "index";
        session()->flash('message', 'Appointment Updated successfully.');
    }


    public function show_create_form()
    {
        $this->_page = "create";
    }

    protected $paginationTheme = 'bootstrap';

    public function add_patient($id)
    {
        $request = RequestedAppointment::find($id);
        Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        session()->flash('message', 'Patient Added Successfully.');
    }

    public function delete($id)
    {
        $patient = RequestedAppointment::find($id)->delete();
        session()->flash('message', 'Appointment Deleted Successfully.');
    }
    public function render()
    {
        if ($this->_page == "index") {
            return view('livewire.admins.requested-appointments.index', [
                'appointments' => RequestedAppointment::latest()->paginate(10),
            ])->layout('admins.layouts.app');
        } elseif ($this->_page == "create") {
            return view('livewire.admins.requested-appointments.create', [
                'patients' => Patient::all(),
                'doctors' => Employee::where('position', 'doctor')->get(),
            ])->layout('admins.layouts.app');
        } elseif ($this->_page == "edit") {
            return view('livewire.admins.requested-appointments.edit', [
                'appointment' => RequestedAppointment::findOrFail($this->edit_operation_report_id),
                'doctors' => Employee::where('position', 'doctor')->get(),
                'patients' => Patient::all(),
            ])->layout('admins.layouts.app');
        }
    }
}
