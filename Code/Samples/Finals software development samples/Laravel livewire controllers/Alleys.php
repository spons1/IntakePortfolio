<?php

namespace App\Livewire\Dashboard\Admin;

use Livewire\Component;
use App\Models\Lane;
use Carbon\Carbon;

class Alleys extends Component
{
    public $lanes;

    public function mount()
    {
        $this->lanes = Lane::orderBy('number')->get();
    }

    public function refreshLanes(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->lanes = Lane::with(['reservations', 'deactivations'])->orderBy('number')->get();
        
        return view('livewire.dashboard.admin.alleys');
    }

    public function delete($id): void
    {
        Lane::findOrFail($id)->delete();
        session()->flash('message', 'Lane deleted successfully.');
        $this->resetPage(); 
    }
}