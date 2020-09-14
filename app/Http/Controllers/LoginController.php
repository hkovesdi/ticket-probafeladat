<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{   
    /**
     * Show the login page
     */
    public function index() 
    {
        return view('login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    public function logout(Request $request) 
    {
        if(Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }
}