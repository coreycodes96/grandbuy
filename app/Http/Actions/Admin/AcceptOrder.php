<?php

namespace App\Http\Actions\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\OrderNotification;

class AcceptOrder
{
    public function execute(Request $request)
    {
        $order = Order::select('user_id', 'product_id', 'amount')->where('id', $request->id)->first();
        $product = Product::select('name', 'image', 'price')->where('id', $order->product_id)->first();
        $user = User::where('id', $order->user_id)->first();

        Order::where('id', $request->id)->update(['status' => 1]);

        $info = [
            'status' => 'Your order is out for delivery',
            'amount' => $order->amount,
            'product_name' => $product->name,
            'product_image' => $product->image,
            'product_price' => $product->price,
        ];

        $user->notify(new OrderNotification($info));

        return response()->json('Order updated', 202);
    }
}
