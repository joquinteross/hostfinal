<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class logoutController extends Controller
{
    public function logout(){
        Session::flush();//elimina variables de decision
        Auth::logout();// metodo laravel para cerra sesion
        return redirect()->route('login');
        
    }
}
