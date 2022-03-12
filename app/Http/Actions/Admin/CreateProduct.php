<?php

namespace App\Http\Actions\Admin;

use App\Models\Product;
use Illuminate\Http\Request;

class CreateProduct
{
    public function execute(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'image' => $request->image,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json($product, 201);
    }
}