<?php

namespace App\Http\Actions\Orders;

use App\Models\Order;

class Show
{
    public function execute(int $id)
    {
        $orders = Order::orderBy('created_at', 'DESC')->where([['user_id', $id], ['status', 0]])->with('products')->get();

        return $orders;
    }
}
