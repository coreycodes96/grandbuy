<?php

namespace App\Http\Actions\Products;

use App\Models\Product;

class Show
{
    public function execute()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        
        return $products;
    }
}
