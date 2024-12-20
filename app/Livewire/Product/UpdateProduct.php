<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UpdateProduct extends Component
{
    public ProductForm $form;

    public function load(int $product):void
    {
        $product =  Product::query()->find($product);
        $this->form->setProduct($product);

    }
    public function update()
    {
        $this->form->update();

        return $this->redirect('/dashboard');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product.update-product');
    }

}
