<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt(
            $request->only(['email', 'password'])
        )) {
            return redirect()->back()->withErrors('Email e/ou senha inválidos.');
        }

        return redirect()->route('series.index');
    }
}
