<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    
    public function index(){
        if(Auth::check()){
            return redirect()->route('panel');
        }
        return view('auth.login');
    }

    public function login(loginRequest $request){
       if(!Auth::validate($request->only('email','password'))){
        return redirect()->to('login')->withErrors('Datos de acceso incorrectos');
       }
       //esto es para crear sesion
       $user=Auth::getProvider()->retrieveByCredentials($request->only('email','password'));
       Auth::login($user);
       return redirect()->route('panel');
    }
}
