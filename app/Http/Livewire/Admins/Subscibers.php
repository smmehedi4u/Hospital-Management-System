<?php

namespace App\Http\Livewire\Admins;

use Livewire\Component;
use App\Models\Subscriber;
use Livewire\WithPagination;

class Subscibers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

     public function delete($id)
    {
        subscriber::findOrFail($id)->delete();
        session()->flash('message', 'Subscriber Deleted Successfully.');

}
    public function render()
    {
        return view('livewire.admins.subscibers',[
            'subscribers' => Subscriber::latest()->paginate(10)
        ])->layout('admins.layouts.app');
    }
}
