<?php

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use function Pest\Laravel\getJson;

it('should be able to see an specific order', function (){
    $user = User::factory()->create([
        'phone' => '1111111111'
    ]);
    $product = Product::factory()->create();

    $order = Order::factory()->create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'status' => OrderStatus::Pendente->value
    ]);

    $request = getJson(route('order.show', $order))
        ->assertSessionHasNoErrors();

    $request->assertJsonStructure([
        'data' => [
            'id',
            'user_id',
            'product_id',
            'status'
        ]
    ]);

    $request->assertExactJson([
        'data' => [
            'id'            => $order->id,
            'user_id'       => $user->id,
            'product_id'    => $product->id,
            'status'        => OrderStatus::Pendente->value
        ]
    ]);
});
