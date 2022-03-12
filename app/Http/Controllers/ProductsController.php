<?php

namespace App\Http\Controllers;

use App\Http\Actions\Products\Index;
use App\Http\Actions\Products\Show;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user']);
    }

    public function index(Index $action)
    {
        return $action->execute();
    }

    public function show(Show $action)
    {
        return response()->json($action->execute(), 200);
    }
}
