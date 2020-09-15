<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{   
    /**
     * Show the login page
     * @return Response
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
            return redirect()->intended(RouteServiceProvider::HOME)->withSuccess(Lang::get('messages.login.success'));
        }
        return redirect()->back()->withErrors(Lang::get('messages.login.error'));
    }

    /**
     * Log the user out
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request) 
    {
        if(Auth::check()) {
            Auth::logout();
        }
        return redirect('/tickets/create')->withSuccess(Lang::get('messages.logout.success'));
    }
}