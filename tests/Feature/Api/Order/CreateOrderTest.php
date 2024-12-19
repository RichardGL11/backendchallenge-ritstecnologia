<?php

use App\Models\Product;
use App\Models\User;
use function Pest\Laravel\postJson;

it('should be able to create an order',function (){
    $user = User::factory()->create([
       'phone' => '1111111111'
    ]);
    $product = Product::factory()->create();

   $request =  postJson(route('order.store'),[
        'user_id' => $user->id,
        'product_id' => $product->id,
       'status' => 'pending'
    ]);

   $request->assertSessionHasNoErrors();
});
