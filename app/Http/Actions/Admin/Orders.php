<?php

namespace App\Http\Actions\Admin;

use App\Models\Order;

class Orders
{
    public function execute()
    {
        $orders = Order::orderBy('created_at', 'DESC')->with('products')->where('status', 0)->get();

        return $orders;
    }
}