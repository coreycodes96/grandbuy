<?php

namespace App\Http\Actions\Admin;

use App\Models\Product;

class Products
{
    public function execute()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();

        return $products;
    }
}