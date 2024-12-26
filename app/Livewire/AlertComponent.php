<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class AlertComponent extends Component
{
    public string $message;

    #[On('echo:Order,.OrderStatusEvent')]
    public function handleMessage(Order $order)
    {
        $this->message = "A New order was created by {$order->user->name}";
        $this->dispatch('showAlert');
    }

    #[Layout('Layouts.app')]
    public function render()
    {
        return view('livewire.alert-component');
    }
}
