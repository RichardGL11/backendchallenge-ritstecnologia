<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DeleteProduct extends Component
{
    public ProductForm $form;

    public function delete(int $id)
    {
        $product = Product::find($id);
        $this->form->setProduct($product);
        $this->form->delete();
        return $this->redirect('/dashboard');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product.delete-product');
    }
}
