<?php

namespace App\Livewire\Dashboard\Admin;

use Livewire\Component;
use App\Models\HorecaProduct;
use Livewire\WithFileUploads;

class HorecaItemCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $price;
    public $discount;
    public $catagory;
    public $image;
    public $is_special_offer = false;
    public $feature_on_top = false;
    public $special_label;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|lte:price',
            'catagory' => 'required|string|max:255',
            'image' => 'nullable|image',
            'is_special_offer' => 'boolean',
            'feature_on_top' => 'boolean',
            'special_label' => 'nullable|string|max:50',
        ]);

        $imagePath = $this->image ? $this->image->store('horeca-images', 'public') : null;

        HorecaProduct::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount ?? 0,
            'catagory' => $this->catagory,
            'image' => $imagePath,
            'is_special_offer' => (bool) $this->is_special_offer,
            'feature_on_top' => (bool) $this->feature_on_top,
            'special_label' => $this->is_special_offer ? ($this->special_label ?: 'Aanbieding') : null,
        ]); 

        session()->flash('success', 'Item created successfully!');
        return redirect()->route('admin.horecaitems');
    }

    public function render()
    {
        return view('livewire.dashboard.admin.horeca-item-create');
    }
}
