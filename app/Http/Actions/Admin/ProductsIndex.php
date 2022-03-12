<?php

namespace App\Http\Actions\Admin;

class ProductsIndex
{
    public function execute()
    {
        return view('layouts.Admin.products');
    }
}
