<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Handle login functionality with rate limiting.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Generate Rate Limiter key based on email and IP address
        $key = Str::lower($credentials['email']) . '|' . $request->ip();

        // Check if user has exceeded login attempts
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'email' => 'Too many login attempts. Please try again in ' . RateLimiter::availableIn($key) . ' seconds.',
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            RateLimiter::clear($key); // Clear attempts after successful login
            return redirect()->intended(route('home.page'));
        }

        // Increment Rate Limiter attempts
        RateLimiter::hit($key, 60); // Lockout for 60 seconds

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle register functionality with rate limiting.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate Rate Limiter key based on email and IP address
        $key = Str::lower($validatedData['email']) . '|' . $request->ip();

        // Check if user has exceeded register attempts
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'email' => 'Too many register attempts. Please try again in ' . RateLimiter::availableIn($key) . ' seconds.',
            ]);
        }

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        RateLimiter::clear($key); // Clear attempts after successful registration

        return redirect()->route('login.page');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.page');
    }
}
