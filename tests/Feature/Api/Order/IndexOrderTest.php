<?php

use App\Enums\OrderStatus;
use App\Models\Order;
use function Pest\Laravel\getJson;

it('should see all the resources',function (){


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
