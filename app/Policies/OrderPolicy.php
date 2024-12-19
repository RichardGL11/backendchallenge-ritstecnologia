<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{

    public function delete(User $user, Order $order): bool
    {

        return (int) $user->id === (int) $order->user_id;
    }


}
