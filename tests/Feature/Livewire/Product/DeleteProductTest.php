<?php

use App\Livewire\Product\CreateProduct;
use App\Livewire\Product\DeleteProduct;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('renders successfully', function () {
    Livewire::test(DeleteProduct::class)
        ->assertStatus(200);
});

it('should be able to delete a product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create([
        'name' => 'product',
        'price' => 100
    ]);

    Livewire::actingAs($user)
        ->test(DeleteProduct::class)
        ->call('delete', $product->id)
        ->assertRedirect('/dashboard');

    assertDatabaseCount(Product::class,0);
    assertDatabaseMissing(Product::class,[
        'id'    => $product->id,
        'name'  => $product->name,
        'price' => $product->price
    ]);
});
