<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //funciones
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){

        // debugear los valores del formulario
        // dump($request->get('username'));

        // validacion formulario
        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:20'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email' => ['required', 'unique:users', 'email', 'max:30'],
            'password' => ['required', 'min:6']
        ]);

        

    }

}
