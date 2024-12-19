<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Enums\OrderStatus;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;
use function Pest\Laravel\withoutExceptionHandling;

it('should be able to create an order',function (){
    withoutExceptionHandling();
    $user = User::factory()->create([
       'phone' => '1111111111'
    ]);
    $product = Product::factory()->create();

   $request =  postJson(route('order.store'),[
        'user_id'    => $user->id,
        'product_id' => $product->id,
        'status'     => OrderStatus::Pendente->value,

    ]);

   $request->assertSessionHasNoErrors();

   assertDatabaseCount(Order::class,1);
   assertDatabaseHas(Order::class,[
       'user_id'    => $user->id,
       'product_id' => $product->id,
       'status'     =>  OrderStatus::Pendente->value
   ]);

});

describe('validation tests', function (){

    test('user_id::validations',function ($rule, $value) {

        $product = Product::factory()->create();

        $request =  postJson(route('order.store'),[
            'user_id'    => $value,
            'product_id' => $product->id,
            'status'     => OrderStatus::Pendente->value,

        ]);

        $request->assertJsonValidationErrors(['user_id' => $rule]);




    })->with([
        'required' => ['The user id field is required',''],
        'exits' =>    ['The selected user id is invalid.', 2]
    ]);

    test('product_id::validations',function ($rule, $value) {

        $user = User::factory()->create([
            'phone' => '1111111111'
        ]);

        $request =  postJson(route('order.store'),[
            'user_id'    => $user->id,
            'product_id' => $value,
            'status'     => OrderStatus::Pendente->value,

        ]);

        $request->assertJsonValidationErrors(['product_id' => $rule]);




    })->with([
        'required' => ['The product id field is required',''],
        'exits' =>    ['The selected product id is invalid.', 2]
    ]);
    test('status::validations',function ($rule, $value) {

        $user = User::factory()->create([
            'phone' => '1111111111'
        ]);
        $product = Product::factory()->create();


        $request =  postJson(route('order.store'),[
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'status'     => $value,

        ]);

        $request->assertJsonValidationErrors(['status' => $rule]);




    })->with([
        'required' => ['The status field is required.',''],
        'enum'   =>   ['The selected status is invalid.','qualquer']
    ]);


});
