<?php

namespace App\Http\Controllers;

use App\Http\Actions\Orders\Index;
use App\Http\Actions\Orders\Show;
use App\Http\Actions\Orders\Create;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user']);
    }

    public function index(Index $action)
    {
        return $action->execute();
    }

    public function show (int $id, Show $action)
    {
        return $action->execute($id);
    }

    protected function create(Request $request, Create $action)
    {
        return $action->execute($request);
    }
}
