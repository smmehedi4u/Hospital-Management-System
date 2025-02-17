<?php

namespace App\Http\Livewire\Admins;

use App\Models\Beds as ModelsBeds;
use App\Models\Rooms;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class Beds extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $room;

    public $patient_id;
    public $room_id;
    // public $status;
    public $alloted_time = '';
    public $discharge_time = '';
    public $edit_bed_id;
    public $button_text = "Add New Bed";

    public $_page;
    public function mount()
    {
        $this->_page = 'index';
    }

    public function show_create_form()
    {
        $this->_page = "create";
    }

    public function show_edit_form($id)
    {
        $this->_page = "edit";
        $Room = ModelsBeds::findOrFail($id);
        $this->edit_bed_id = $id;
        $this->room_id = $Room->room_id;
        $this->patient_id = $Room->patient_id;
        // $this->status = $Room->status;
        $this->alloted_time = $Room->alloted_time;
        $this->discharge_time = $Room->discharge_time;

        $this->button_text = "Update Room";
    }

    public function show_index()
    {
        $this->_page = "index";
    }

    public function add_bed()
    {
        if ($this->edit_bed_id) {

            $this->update($this->edit_bed_id);

        } else {

            $this->validate([
                'room_id' => 'required|numeric',
                'patient_id' => 'required|numeric',
                // 'status' => "required",
                'alloted_time' => "required",
                'discharge_time' => "required",
            ]);

            ModelsBeds::create([
                'room_id' => $this->room_id,
                'patient_id' => $this->patient_id,
                // 'status' => $this->status,
                'alloted_time' => $this->alloted_time,
                'discharge_time' => $this->discharge_time,
            ]);

            $this->room_id = null;
            $this->patient_id = null;
            // $this->status = null;
            $this->alloted_time = null;
            $this->discharge_time = null;

            session()->flash('message', 'Bed Assigned successfully.');
            $this->_page = "index";
        }

    }



    public function update($id)
    {
        $this->validate([
            'room_id' => 'required|numeric',
            'patient_id' => 'required|numeric',
            // 'status' => "required",
            'alloted_time' => "required",
            'discharge_time' => "required",
        ]);

        $bed = ModelsBeds::findOrFail($id);
        $bed->room_id = $this->room_id;
        $bed->patient_id = $this->patient_id;
        // $bed->status = $this->status;
        $bed->alloted_time = $this->alloted_time;
        $bed->discharge_time = $this->discharge_time;

        $bed->save();

        $this->room_id = null;
        $this->patient_id = null;
        // $this->status = null;
        $this->alloted_time = null;
        $this->discharge_time = null;

        $this->edit_bed_id = null;

        session()->flash('message', 'Bed Updated Successfully.');

        $this->button_text = "Add New Bed";
        $this->_page = "index";

    }

    public function delete($id)
    {
        ModelsBeds::findOrFail($id)->delete();
        session()->flash('message', 'Room Deleted Successfully.');

        $this->room_id = null;
        $this->patient_id = null;
        // $this->status = null;
        $this->alloted_time = null;
        $this->discharge_time = null;
    }
    public function render()
    {
        if ($this->_page == "index") {
            return view('livewire.admins.beds.index', [
                'beds' => ModelsBeds::latest()->paginate(10)
            ])->layout('admins.layouts.app');
        } else if ($this->_page == "create") {
            return view('livewire.admins.beds.create', [
                'patients' => Patient::all(),
                'rooms' => Rooms::where('status', 'Available')->get(),
            ]);
        } else if ($this->_page == "edit") {
            return view('livewire.admins.beds.edit', [
                'patients' => Patient::all(),
                'rooms' => Rooms::where('status', 'Available')->get(),
            ]);
        }
    }
}
