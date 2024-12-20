<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\ProductForm;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateProduct extends Component
{
    public ProductForm $form;

    public function save()
    {
        $this->form->save();
        return $this->redirect('/dashboard');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product');
    }
}
