<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function register(Request $request){

        // Validate data
        $fields = $request->validate([
            'username' => ['required', 'max:255'] ,
            'email' => ['required', 'max:255', 'email', 'unique:users'] , // unique:table,column,excep
            'password' => ['required', 'min:3', 'max:255', 'confirmed'] ,
        ]);

        // Register user
        $user = User::create($fields);

        // Login
        Auth::login($user);

        // Redirect 
        return redirect()->route('dashboard');

    }

    public function login(Request $request){

        // Validate data
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'] ,
            'password' => ['required'] ,
        ]);

        // Try to Login
        if( Auth::attempt($fields, $request->remember) ){
            // Redirect to Intended Page
            return redirect()->intended('dashboard');
        }else{
            // Redirect Back
            return back()->withErrors([
                'failed' => 'The provided credentials do NOT match our records.' ,
            ]);
        }

    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');


    }



}
