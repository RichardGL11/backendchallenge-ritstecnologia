<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Events\OrderStatusEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\NotifyTelegram;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return OrderResource::collection(Order::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request):Response
    {
       $order = Order::query()->create([
           'user_id'     => auth()->user()->id,
           'product_id' => $request->validated('product_id'),
           'status'      => $request->enum('status', OrderStatus::class),
        ]);

       OrderStatusEvent::dispatch($order);
       NotifyTelegram::dispatch($order);

       return response(new OrderResource($order), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): OrderResource
    {
        return OrderResource::make($order);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        Gate::authorize('delete', $order);
        $order->delete();
    }
}
