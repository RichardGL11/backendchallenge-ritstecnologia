<?php

use App\Livewire\Product\CreateProduct;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function () {
    Livewire::test(CreateProduct::class)
        ->assertStatus(200);
});

it('should be able to create an Product', function () {
    $user = User::factory()->createOne();

    $livewire = Livewire::actingAs($user)
                ->test(CreateProduct::class)
                ->set('form.name','nome')
                ->set('form.price','150')
                ->call('save')
                ->assertHasNoErrors();

    $livewire->assertRedirect('/dashboard');
    assertDatabaseCount(Product::class,1);
    assertDatabaseHas(Product::class,[
        'name' => 'nome',
        'price' => 150
    ]);
});


