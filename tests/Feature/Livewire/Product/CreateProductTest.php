<?php

use App\Livewire\Product\CreateProduct;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
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


describe('validation tests', function (){

    beforeEach(function (){
       $this->user = User::factory()->createOne();
       actingAs($this->user);
    });

    test('name::validations', function ($rule, $value){

        Livewire::test(CreateProduct::class)
            ->set('form.name',$value)
            ->set('form.price','150')
            ->call('save')
            ->assertHasErrors(['form.name' => $rule]);

    })->with([
        'required' => ['required', ''],
        'min'      => ['min:3', 'aa'],
        'max'      => ['max:255', str_repeat('a',256)]
    ]);

});


