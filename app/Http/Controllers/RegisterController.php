<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'=> 'required|min:5|max:255',
            'username'=> ['required', 'min:6', 'max:10', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password'=> 'required|min:8|max:122',
        ]);

        // $validatedData = bcrypt($validatedData['password']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request->session()->flash('success','Registrasi Berhasil !');

        return redirect('/login')->with('success','Registrasi Berhasil !');
    }
}
