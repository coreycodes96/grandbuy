<?php

namespace App\Http\Actions\Orders;
use App\Models\Order;
use Illuminate\Http\Request;

class Create
{
    public function execute(Request $request)
    {
        Order::create([
            'user_id' => $request->userId,
            'product_id' => $request->items[0]['item'],
            'amount' => $request->items[0]['amount'],
        ]);

        return response()->json('Your order has been successfully placed.', 201);
    }
}
