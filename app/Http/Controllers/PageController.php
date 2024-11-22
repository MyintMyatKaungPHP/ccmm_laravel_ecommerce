<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    // Login Page
    public function login()
    {
        return view('login');
    }

    // Register Page
    public function register()
    {
        return view('register');
    }
}
