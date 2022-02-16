<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()){
            return redirect()->route('Admin.Dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Session::flash('type', 'success');
            Session::flash('message', 'Logado com sucesso!');

            return redirect()->route('dashboard');
        }

        Session::flash('type', 'error');
        Session::flash('message', 'Verifique suas informações de login.');
        dump('a');
        return redirect()->route('Login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
