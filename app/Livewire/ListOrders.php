<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

use Livewire\Attributes\On;
use Livewire\Component;

class ListOrders extends Component
{
    #[Computed]
    public function orders()
    {
        return Order::all();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.list-orders');
    }

    #[On('echo:Order,.OrderStatusEvent')]
    public function newOrder():void
    {
         unset($this->orders);

    }


}
