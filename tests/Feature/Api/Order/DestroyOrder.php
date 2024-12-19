<?php

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\withoutExceptionHandling;

it('should not be able to destroy an Order if the user_id is different them the authenticated user', function (){
    $user = User::factory()->create([
        'phone'=> '11111111111'
    ]);
    $order = Order::factory()->create([
        'user_id' => 2,
        'product_id' => 1,
        'status' => OrderStatus::Pendente->value
    ]);

    Sanctum::actingAs($user);

    delete(route('order.destroy', $order))
        ->assertForbidden();

});
it('should  be able to destroy an Order if the user_id is the same as  authenticated user', function (){

    $user = User::factory()->create([
        'phone'=> '11111111111'
    ]);
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'product_id' => 1,
        'status' => OrderStatus::Pendente->value
    ]);

    Sanctum::actingAs($user);

    delete(route('order.destroy', $order))
        ->assertOk();
    assertDatabaseCount(Order::class,0);

    assertDatabaseMissing(Order::class,[
        'user_id' => $user->id,
        'product_id' => 1,
        'status' => OrderStatus::Pendente->value
    ]);

});
