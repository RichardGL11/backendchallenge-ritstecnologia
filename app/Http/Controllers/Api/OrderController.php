<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
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
           'user_id'     => $request->validated('user_id'),
           'product_id' => $request->validated('product_id'),
           'status'      => $request->enum('status', OrderStatus::class),
        ]);

       return response()->setStatusCode(Response::HTTP_CREATED);
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
