<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //cerrar sesion
    public function store(){

        auth()->logout();
        return redirect()->route('login');

    }

}
