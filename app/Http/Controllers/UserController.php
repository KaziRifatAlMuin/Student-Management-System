<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'user',
            ]);
        } catch (QueryException $e) {
            // MySQL duplicate entry code is 23000 — return friendly error
            if ($e->getCode() === '23000') {
                return back()
                    ->withInput($request->except('password', 'password_confirmation'))
                    ->withErrors(['email' => 'This email is already registered. Please login or use a different email.']);
            }

            throw $e;
        }

        Auth::login($user);

        return redirect()->intended(route('dashboard'))
            ->with('success', 'Registration successful!');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Ensure users are redirected to dashboard (or intended URL)
            return redirect()->intended(route('dashboard'))
                ->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            # code...
            return view('dashboard');
        }
        else{
            return redirect()->route('login');
        }
        
    }
    //middle ware
    public function manageStudent()
    {
       
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
        
    }
    
}
