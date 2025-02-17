<?php

namespace App\Http\Livewire\Admins;
use App\Models\Bill;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class Bills extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $patient_id;
    public $amount;
    public $payed;
    public $edit_bill_id;
    public $button_text = "Add New Bill";

    public function mount(Bill $bill)
    {
        $this->payed = $bill->payed;
    }

    public function add_bill()
    {
        if ($this->edit_bill_id) {

            $this->update($this->edit_bill_id);

        }else{

           $this->validate([
            'patient_id' => 'required',
            'amount' => 'required',
            'payed' => 'required',
            ]);

            Bill::create([
                'patient_id'         => $this->patient_id,
                'amount'         => $this->amount,
                'payed'         => $this->payed,
            ]);

            $this->patient_id=null;
            $this->amount=null;
            $this->payed=null;

            session()->flash('message', 'Bill Created successfully.');
        }

    }


     public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        $this->edit_bill_id = $id;
        $this->patient_id = $bill->patient_id;
        $this->amount = $bill->amount;
        $this->payed = $bill->payed;

        $this->button_text="Update Bill";
    }

    public function update($id)
    {
        $this->validate([
            'patient_id' => 'required',
            'amount' => 'required',
            'payed' => 'required',
            ]);

        $bill = Bill::findOrFail($id);
        $bill->patient_id = $this->patient_id;
        $bill->amount = $this->amount;
        $bill->payed = $this->payed;

        $bill->save();

        $this->patient_id=null;
        $this->amount=null;
        $this->payed=null;

        $this->edit_bill_id=null;

        session()->flash('message', 'Bill Updated Successfully.');

        $this->button_text = "Add New Bill";

}

     public function delete($id)
    {
        Bill::findOrFail($id)->delete();
        session()->flash('message', 'Bill Deleted Successfully.');

        $this->patient_id=null;
        $this->amount=null;
        $this->payed=null;
}
    public function render()
    {
        return view('livewire.admins.bills',[
            'bills' =>Bill::latest()->paginate(10),
            'patients' =>Patient::all()
        ])->layout('admins.layouts.app');
    }
}
