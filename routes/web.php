<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;

Auth::routes();

//Welcome Controller
Route::get('/', [WelcomeController:: class, 'index']);