<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/products';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $data)
    {
        $data->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:255']
        ]);

        if (User::where('email', $data['email'])->count() === 0) {
            return response()->json(['errors' => ['email' => ['The email you have entered does not exist']]], 422);
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            $admin = User::select('admin')->where('email', $data['email'])->get();
            return response()->json($admin[0], 200);
        }else 
        {
            return response()->json('Incorrect Data', 422);
        }
    }
}