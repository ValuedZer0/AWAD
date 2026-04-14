<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Users can view their own orders.
     */
    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || $user->isAdmin();
    }

    /**
     * Only admins can update order status.
     */
    public function updateStatus(User $user, Order $order)
    {
        return $user->isAdmin();
    }
}
