<?php

namespace App\Livewire\Dashboard\Admin;

use App\Models\User;
use Livewire\Component;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $status;
    public $password;
    public $password_confirmation;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'status' => 'required',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'status' => $this->status,
        ]);

        session()->flash('success', 'User created successfully!');
        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('livewire.dashboard.admin.user-create');
    }
}
