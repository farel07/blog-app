<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Register',
            'active' => 'login'
        ];

        return view('register/index', $data);
    }

    public function store(Request $request)
    {
        // jika tidak lolos validasi program dibawahnya tidak akan dijalankan
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|min:4|max:255',
            'email' => 'required|unique:users|email:dns',
            'password' => 'required|min:5|max:255'
        ]);
        // enkipsi password
        $validatedData['password'] = bcrypt($validatedData['password']);


        // masukkan data user ke dalam tabel user
        User::create($validatedData);
        // buat session untuk flash message
        $request->session()->flash('success', 'Account succesfully registred!, please login.');
        // pindahkan ke halaman login
        return redirect('/login');
    }
}
