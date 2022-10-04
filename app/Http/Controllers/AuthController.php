<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function index()
    {
        if (!Auth::guard('web')->check()) {
            return view('login.index');
        } else {
            return redirect()->route('index');
        }
    }

    function login_post(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        // dd($request->all());

        if ($validator->fails()) {
            return redirect()->route('login.index')->with('error', true);
        }
        $data = [
            'username'  => $request->username,
            'password'  => $request->password,
        ];

        Auth::guard('web')->attempt($data);

        if (Auth::guard('web')->check()) {
            return redirect()->route('index');
        } else {
            return redirect()->route('login.index')->with('error', true);
        }
    }

    function logout(Request $request)
    {
    }
}
