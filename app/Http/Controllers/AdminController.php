<?php

namespace App\Http\Controllers;
use App\Http\Actions\Admin\OrdersIndex;
use App\Http\Actions\Admin\ProductsIndex;
use App\Http\Actions\Admin\Orders;
use App\Http\Actions\Admin\Products;
use App\Http\Actions\Admin\AcceptOrder;
use App\Http\Actions\Admin\CancelOrder;
use App\Http\Actions\Admin\CreateProduct;
use App\Http\Actions\Admin\DeleteProduct;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function ordersindex(OrdersIndex $action)
    {
        return $action->execute();
    }

    public function productsindex(ProductsIndex $action)
    {
        return $action->execute();
    }

    public function showOrders(Orders $action)
    {
        return $action->execute();
    }

    public function showProducts(Products $action)
    {
        return $action->execute();
    }

    protected function acceptOrder(Request $request, AcceptOrder $action)
    {
        return $action->execute($request);
    }

    protected function cancelOrder(int $id, CancelOrder $action)
    {
        return $action->execute($id);
    }

    protected function createProduct(Request $request, CreateProduct $action)
    {
        return $action->execute($request);
    }

    protected function deleteProduct(int $id, DeleteProduct $action)
    {
        return $action->execute($id);
    }
}
