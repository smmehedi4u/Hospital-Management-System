<?php

namespace App\Http\Livewire\Admins;

use Livewire\Component;
use App\Models\Employee;
use App\Models\operationreport as ModelsOperationreport;
use App\Models\Patient;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Operationreport extends Component
{

    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $patient;
    public $details;
    public $doctor;
    public $status;

    public $edit_operation_report_id;
    public $button_text = "Add New Operation Report";
    public $_page;
    public function mount()
    {
        $this->_page = 'index';
        $this->status = $this->status ?? 'pending';
    }


    public function show_create_form()
    {
        $this->_page = "create";
    }


    public function add_operationreport()
    {
        if ($this->edit_operation_report_id) {

            $this->update($this->edit_operation_report_id);

        } else {
            $this->validate([
                'patient' => 'required',
                'details' => 'required',
                'doctor' => 'required',
                'status' => 'required',
            ]);

            ModelsOperationreport::create([
                'patient_id' => $this->patient,
                'description' => $this->details,
                'employee_id' => $this->doctor,
                'status' => $this->status,
            ]);

            $this->patient = "";
            $this->details = "";
            $this->doctor = "";
            $this->status = "";
            $this->_page = 'index';
            session()->flash('message', 'Operation Report Created successfully.');
        }

    }


    public function edit($id)
    {
        $Operationreport = ModelsOperationreport::findOrFail($id);
        $this->edit_operation_report_id = $id;

        $this->patient = $Operationreport->patient_id;
        $this->details = $Operationreport->description;
        $this->doctor = $Operationreport->employee_id;
        $this->status = $Operationreport->status;
        $this->_page = 'edit';
    }

    public function update($id)
    {
        $this->validate([
            'patient' => 'required',
            'details' => 'required',
            'doctor' => 'required',
            'status' => 'required',
        ]);

        $Operationreport = ModelsOperationreport::findOrFail($id);
        $Operationreport->patient_id = $this->patient;
        $Operationreport->description = $this->details;
        $Operationreport->employee_id = $this->doctor;
        $Operationreport->status = $this->status;

        $Operationreport->save();

        $this->patient = "";
        $this->details = "";
        $this->doctor = "";
        $this->status = "";
        $this->edit_operation_report_id = "";

        session()->flash('message', 'Operation Report Updated Successfully.');
        $this->_page = 'index';
    }

    public function delete($id)
    {
        ModelsOperationreport::findOrFail($id)->delete();
        session()->flash('message', 'Operation report Deleted Successfully.');

        $this->patient = "";
        $this->details = "";
        $this->doctor = "";
        $this->status = "";
    }




    public function render()
    {
        if ($this->_page == "index") {
            return view('livewire.admins.operationreport.index', [
                'reports' => ModelsOperationreport::latest()->paginate(10),
            ])->layout('admins.layouts.app');
        } elseif ($this->_page == "create") {
            return view('livewire.admins.operationreport.create', [
                'employees' => Employee::where('position', 'doctor')->get(),
                'patients' => Patient::all(),
            ])->layout('admins.layouts.app');
        } elseif ($this->_page == "edit") {
            return view('livewire.admins.operationreport.edit', [
                'report' => ModelsOperationreport::findOrFail($this->edit_operation_report_id),
                'employees' => Employee::where('position', 'doctor')->get(),
                'patients' => Patient::all(),
            ])->layout('admins.layouts.app');
        }

    }

}
