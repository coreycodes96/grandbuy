<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

//Order Routes
Route::get('/admin/orders', [AdminController::class, 'ordersindex']);
Route::get('/admin/orders/show', [AdminController::class, 'showOrders']);
Route::put('/admin/orders/accept', [AdminController::class, 'acceptOrder']);
Route::delete('/admin/orders/cancel/{id}', [AdminController::class, 'cancelOrder']);

//Products Routes
Route::get('/admin/products', [AdminController::class, 'productsIndex']);
Route::get('/admin/products/show', [AdminController::class, 'showProducts']);
Route::post('/admin/products/create', [AdminController::class, 'createProduct']);
Route::delete('/admin/products/delete/{id}', [AdminController::class, 'deleteProduct']);