<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(Request $request){

        return view('auth.login');
    }

    public function store(Request $request){

        // validar el formulario
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // verificar si las credenciales son las que existen en la db
        if(!auth()->attempt($request->only('email', 'password'))){
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        // si todo esta bien redireccionamos
        return redirect()->route('posts.index');

    }
}
