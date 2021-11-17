<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        $bodyParams = $request->except('_token');
        $bodyParams['password'] = Hash::make($bodyParams['password']);
        $user = User::create($bodyParams);

        Auth::login($user);

        return redirect()->route('series.index');
    }
}
