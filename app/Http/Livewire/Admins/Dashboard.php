<?php

namespace App\Http\Livewire\Admins;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admins.dashboard',[
            'employees'=>\App\Models\Employee::count(),
            'appointments'=>\App\Models\RequestedAppointment::count(),
            'birthreports'=>\App\Models\Birthreport::count(),
            'operationreports'=>\App\Models\Operationreport::count(),
            'patients'=>\App\Models\Patient::count(),
            'blocks'=>\App\Models\Block::count(),
            'rooms'=>\App\Models\Rooms::count(),
            'beds'=>\App\Models\Beds::count(),
            'subscribers'=>\App\Models\Subscriber::count(),
        ])->layout('admins.layouts.app');
    }
}
