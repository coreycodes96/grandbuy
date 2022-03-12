<?php

namespace App\Http\Actions\Admin;

use App\Models\Product;

class DeleteProduct
{
    public function execute(int $id)
    {
        Product::where('id', $id)->delete();

        return response()->json('Product has been deleted', 204);
    }
}