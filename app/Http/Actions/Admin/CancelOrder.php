<?php

namespace App\Http\Actions\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderNotification;

class CancelOrder
{
    public function execute(int $id)
    {
        $order = Order::select('user_id', 'product_id', 'amount')->where('id', $id)->first();
        $product = Product::select('name', 'image', 'price')->where('id', $order->product_id)->first();
        $user = User::where('id', $order->user_id)->first();

        $info = [
            'status' => 'Your delivery has been cancelled',
            'amount' => $order->amount,
            'product_name' => $product->name,
            'product_image' => $product->image,
            'product_price' => $product->price,
        ];

        $user->notify(new OrderNotification($info));

        Order::where('id', $id)->delete();

        return response()->json('Order cancelled', 204);
    }
}
