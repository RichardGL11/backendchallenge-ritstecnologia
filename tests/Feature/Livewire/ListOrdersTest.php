<?php

use App\Enums\OrderStatus;
use App\Livewire\ListOrders;
use App\Models\Order;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ListOrders::class)
        ->assertStatus(200);
});

test('should see all the orders', function () {
    $user = \App\Models\User::factory()->create();
    $orders = Order::factory(20)->create([
        'user_id' => $user->id,
        'product_id' => 1,
        'status' => OrderStatus::EmPreparo->value
    ]);

   $livewire =  Livewire::actingAs($user)
                ->test(ListOrders::class);

   $orders->each(function (Order $order) use ($livewire) {
       $livewire->assertSee($order->id);
       $livewire->assertSee($order->user->email);
       $livewire->assertSee($order->user->name);
       $livewire->assertSee($order->created_at->format('d/m/y'));
       $livewire->assertSee($order->status);
       $livewire->assertSee('See Items');

   });

});
