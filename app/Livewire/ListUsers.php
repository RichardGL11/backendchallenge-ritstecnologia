<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListUsers extends Component
{
    #[Computed]
    public function users()
    {
        return User::all();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.list-users');
    }
}
