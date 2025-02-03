<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() 
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('login');
    }
    
    public function store(Request $request) 
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $authenticated = Auth::attempt($credentials);

        if (!$authenticated) {
            return redirect()->route('login')->withErrors(['error' => 'Invalid crendentials.']);
        }

        return redirect()->route('home');
    }

    public function destroy() 
    {
        Auth::logout();
        return redirect()->route('login');      
    }
}
