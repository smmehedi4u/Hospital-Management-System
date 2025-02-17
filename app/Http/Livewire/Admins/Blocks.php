<?php

namespace App\Http\Livewire\Admins;

use Livewire\Component;
use App\Models\Block;
use Livewire\WithPagination;

class Blocks extends Component
{

    use WithPagination;


    protected $paginationTheme = 'bootstrap';

    public $blockname;
    public $blockcode;

    public $edit_item_id;
    public $button_text = "Add New";

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
        $this->edit_item_id = $id;
        $item = Block::find($id);
        $this->blockname = $item->blockname;
        $this->blockcode = $item->blockcode;
    }

    public function show_index()
    {
        $this->_page = "index";
    }

    public function add_item()
    {
        $this->validate([
            'blockname' => "required|string",
            'blockcode' => "required",
        ]);
        Block::create([
            'blockname' => $this->blockname,
            'blockcode' => $this->blockcode,
        ]);
        $this->blockname = "";
        $this->blockcode = "";
        session()->flash('message', 'Block Added successfully.');
        $this->_page = "index";
    }

    public function update()
    {
        $this->validate([
            'blockname' => "required|string",
            'blockcode' => "required",
        ]);

        $item = Block::findOrFail($this->edit_item_id);
        $item->blockname = $this->blockname;
        $item->blockcode = $this->blockcode;
        $item->save();
        $this->blockname = "";
        $this->blockcode = "";
        $this->edit_item_id = "";
        $this->_page = "index";
        session()->flash('message', 'Block Updated Successfully.');
    }

    public function delete($IdToDelete)
    {
        Block::findOrFail($IdToDelete)->delete();
        session()->flash('message', 'Block Deleted Successfully.');
        // $this->doctor = "";
    }
    public function render()
    {
        if ($this->_page == "index") {
            return view('livewire.admins.block.index', [
                'blocks' => Block::latest()->paginate(10),
            ])->layout('admins.layouts.app');
        } else if ($this->_page == "create") {
            return view('livewire.admins.block.create');
        } else if ($this->_page == "edit") {
            return view('livewire.admins.block.edit');
        }
    }
}
