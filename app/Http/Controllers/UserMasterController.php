<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserMasterController extends Controller
{
    /**
     * Shows a user register form.
     */
    public function register(Request $request)
    {
        return view('user.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        dd($validator,$validator->fails());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('login')->with('success', 'User registered successfully, Please login.');
    }

    /**
     * Show login form.
     */
    public function login(Request $request)
    {
        return view('user.login');
    }
    /**
     * Login to system.
     */
    public function auth(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable', 'in:on'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'Invalid Credentials'
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
