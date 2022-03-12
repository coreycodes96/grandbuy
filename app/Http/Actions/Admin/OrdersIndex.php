<?php

namespace App\Http\Actions\Admin;

class OrdersIndex
{
    public function execute()
    {
        return view('layouts.Admin.orders');
    }
}
