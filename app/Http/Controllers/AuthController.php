<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // loginPage
    function loginPage(){
        return view('auth.login');
    }
    
     // registerPage
     function registerPage(){
        return view('auth.register');
    }

    // dashboard
    function dashboard(){
        return redirect()->route('category@categoryListPage');
    }

    //logout
    function logout(){
        Auth::logout();
        return view('auth.login');
    }
}
