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
