<?php

namespace App\Http\Actions\Orders;

class Index
{
    public function execute()
    {
        return view('layouts.Orders.orders');
    }
}
