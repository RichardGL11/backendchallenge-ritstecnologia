<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    #[Validate('required|min:3|max:255')]
    public string $name = "";
    #[Validate('required|numeric|min_digits:1')]
    public string $price = "";

    public ?Product $product = null;


    public function setProduct(Product $product)
    {
         $this->product = $product;
         $this->name =  $product->name;
         $this->price = (float) $product->price;

    }

    public function update()
    {
        $this->validate();

        $this->product->update(
            $this->all()
        );
    }
    public function save()
    {
        $this->validate();

        Product::query()->create([
            'name' => $this->name,
            'price' => (float) $this->price,
        ]);

    }

    public function delete()
    {
        $this->product->delete();
    }
}
