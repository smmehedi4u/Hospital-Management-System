<?php

namespace App\Http\Livewire\Admins;

use App\Models\Patient;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Patients extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $email;
    public $phone;
    public $gender;
    public $age;
    public $address;
    public $bloodgroup;
    public $photo;
    public $edit_photo;
    public $edit_patient_id;
    public $button_text = "Add New Patient";

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
        $patient = Patient::findOrFail($id);
        $this->edit_patient_id = $id;

        $this->name = $patient->name;
        $this->email = $patient->email;
        $this->phone = $patient->phone;
        $this->address = $patient->address;
        $this->gender = $patient->gender;
        $this->age = $patient->age;
        $this->bloodgroup = $patient->bloodgroup;
        $this->edit_photo = $patient->photo_path;
    }

    public function show_index()
    {
        $this->_page = "index";
    }

    public function add_patient()
    {
        if ($this->edit_patient_id) {

            $this->update($this->edit_patient_id);

        } else {
            $this->validate([
                'name' => 'required||min:6|max:50',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'address' => 'required',
                'gender' => 'required',
                'age' => 'required',
                'bloodgroup' => 'nullable',
                'photo' => 'nullable|max:3072',
            ]);

            Patient::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'gender' => $this->gender,
                'age' => $this->age,
                'bloodgroup' => $this->bloodgroup,
                'photo_path' => $this->storeImage(),
            ]);
            //unset variables
            $this->name = "";
            $this->email = "";
            $this->phone = "";
            $this->address = "";
            $this->gender = "";
            $this->age = "";
            $this->bloodgroup = "";
            $this->photo = "";

            session()->flash('message', 'Patient Created successfully.');
            $this->_page = "index";
        }

    }

    public function storeImage()
    {
        if (!$this->photo) {
            return null;
        }
        $imag = ImageManagerStatic::make($this->photo)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $imag);
        return $name;
    }


    public function update($id)
    {
        $this->validate([
            'name' => 'required||min:6|max:50',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'bloodgroup' => 'nullable',
            'photo' => 'nullable|max:3072',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->name = $this->name;
        $patient->email = $this->email;
        $patient->phone = $this->phone;
        $patient->address = $this->address;
        $patient->gender = $this->gender;
        $patient->age = $this->age;
        $patient->bloodgroup = $this->bloodgroup;

        if ($this->photo) {
            Storage::disk('public')->delete($patient->photo_path);
            $patient->photo_path = $this->storeImage();

        }

        $patient->save();

        $this->name = "";
        $this->email = "";
        $this->phone = "";
        $this->address = "";
        $this->gender = "";
        $this->age = "";
        $this->bloodgroup = "";
        $this->photo = "";
        $this->edit_photo = "";
        $this->edit_patient_id = "";

        session()->flash('message', 'Patient Updated Successfully.');

        $this->button_text = "Add New Patient";
        $this->_page = "index";
    }

    public function delete($id)
    {
        $patient = Patient::find($id);
        Storage::disk('public')->delete($patient->photo_path);
        $patient->delete();
        session()->flash('message', 'Patient Deleted Successfully.');
    }

    public function render()
    {
        if ($this->_page == "index") {
            return view('livewire.admins.patients.index', [
                'patients' => Patient::latest()->paginate(10),
            ])->layout('admins.layouts.app');
        } else if ($this->_page == "create") {
            return view('livewire.admins.patients.create');
        } else if ($this->_page == "edit") {
            return view('livewire.admins.patients.edit');
        }
    }
}
