<?php

use App\Enums\OrderStatus;
use App\Models\Order;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('should see all the resources',function (){

    Sanctum::actingAs(\App\Models\User::factory()->create());
    $orders = Order::factory(4)->create([
        'user_id' => 1,
        'product_id' => 1,
        'status' => OrderStatus::Pendente->value
    ]);


    $request = getJson(route('order.index'));

    $request->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'user_id',
                'product_id',
                'status',
            ],
        ],
    ]);

    $orders->each(function ($order) use ($request) {
        $request->assertJsonFragment([
            'id'         => $order->id,
            'user_id'    => 1,
            'product_id' => 1,
            'status'     => OrderStatus::Pendente->value,
        ]);
    });


});
