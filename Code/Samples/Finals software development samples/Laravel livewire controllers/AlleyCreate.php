<?php

namespace App\Livewire\Dashboard\Admin;

use App\Models\Lane;
use Livewire\Component;

class AlleyCreate extends Component
{   
    public $label;
    public $number;
    public $query;
    //public $is_active;

    public function submit()
    {
        $this->validate([
            'label' => 'string|max:255',
            'number' => 'required|integer',
            //'is_active' => 'boolean',
        ]);

        Lane::create([
            'label' => $this->label,
            'number' => $this->number,
            //'is_active' => $this->is_active ?? false,
        ]);

        session()->flash('success', 'Lane created successfully!');
        return redirect()->route('admin.alleys');
    }

    public function render()
    {
        return view('livewire.dashboard.admin.alley-create');
    }
}
