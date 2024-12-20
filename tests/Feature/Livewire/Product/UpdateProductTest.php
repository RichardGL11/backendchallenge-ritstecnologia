<?php

use App\Livewire\Product\UpdateProduct;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('renders successfully', function () {
    Livewire::test(UpdateProduct::class)
        ->assertStatus(200);
});


it('should be able to update a product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create([
        'name' => 'product',
        'price' => 20
    ]);

    Livewire::actingAs($user)
        ->test(UpdateProduct::class)
        ->call('load', $product->id)
        ->set('form.name', 'updatedname')
        ->assertSet('form.name', 'updatedname')
        ->set('form.price','1000')
        ->assertSet('form.price', '1000')
        ->call('update')
        ->assertHasNoErrors()
        ->assertRedirectToRoute('dashboard');

    assertDatabaseCount(Product::class,1);
    assertDatabaseMissing(Product::class,[
        'name' => 'product',
        'price' => 20
    ]);
    assertDatabaseHas(Product::class,[
        'name' => 'updatedname',
        'price' => 1000
    ]);

});
