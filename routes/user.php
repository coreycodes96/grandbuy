<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\NotificationsController;

//Order Routes
Route::get('/orders', [OrdersController:: class, 'index']);
Route::get('/orders/show/{id}', [OrdersController::class, 'show']);
Route::post('/orders/create', [OrdersController::class, 'create']);

//Products Routes
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/show', [ProductsController::class, 'show']);

//Notifications Routes
Route::get('/notifications', [NotificationsController:: class, 'index']);
Route::get('/notifications/show/{id}', [NotificationsController:: class, 'show']);
Route::get('/notifications/notification/{id}', [NotificationsController::class, 'getNotification']);
Route::delete('/notifications/delete/{id}/', [NotificationsController:: class, 'delete']);