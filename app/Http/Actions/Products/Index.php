<?php

namespace App\Http\Actions\Products;

class Index
{
    public function execute()
    {
        return view('layouts.Products.products');
    }
}
