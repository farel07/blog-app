<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login',
            'active' => 'login'
        ];

        return view('login/index', $data);
    }


    public function auth(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email:dns|exists:users,email',
            'password' => 'required'
        ], [
            'email.exists' => 'Email not registred!.'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->with('login_error', 'Email or Password is incorrect!.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
