<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login')->with([
            'title' => 'Login',
        ]);
    }
    
    public function showRegister(){
        return view('auth.register')->with([
            'title' => 'Register',
        ]);
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
        ]);

        if(Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password'], 'is_admin' => 1])){
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'The provided credentials do not match our records.')->onlyInput('email');
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|min:6|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:16',
        ]);

        $validatedData['is_admin'] = true;
        $validatedData['name'] = $request['username'];
        User::Create($validatedData);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('login');
    }
}
