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

describe('validations', function (){

    beforeEach(function (){
        $this->user = User::factory()->create();
        $this->product = Product::factory()->create([
            'name' => 'product',
            'price' => 20
        ]);

    });

    test('name', function ($rule, $value){
        Livewire::actingAs($this->user)
            ->test(UpdateProduct::class)
            ->call('load', $this->product->id)
            ->set('form.name', $value)
            ->assertSet('form.name', $value)
            ->set('form.price','1000')
            ->assertSet('form.price', '1000')
            ->call('update')
            ->assertHasErrors(['form.name' => $rule]);

    })->with([
        'required' => ['required',''],
        'min'      => ['min:3', 'aa'],
        'max'      => ['max:255', str_repeat('a',256)],
    ]);

    test('price', function ($rule, $value){
        Livewire::actingAs($this->user)
            ->test(UpdateProduct::class)
            ->call('load', $this->product->id)
            ->set('form.name', 'qualquerum')
            ->assertSet('form.name', 'qualquerum')
            ->set('form.price', $value)
            ->assertSet('form.price', $value)
            ->call('update')
            ->assertHasErrors(['form.price' => $rule]);

    })->with([
        'required' => ['required',''],
        'min_digits'      => ['min_digits:1', '/'],
        'numeric'      => ['numeric', 'aaaa'],
    ]);

});
