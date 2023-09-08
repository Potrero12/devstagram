<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    //funciones
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){

        // debugear los valores del formulario
        // dump($request->get('username'));

        // modificar el request //opcional
        $request->request->add(['username' => Str::slug($request->username)]);

        // validacion formulario
        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:20'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email' => ['required', 'unique:users', 'email', 'max:30'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        // guardando el nuevo usuario
        User::create([
            'name' => Str::studly($request->name),
            'username' => Str::slug($request->username), //se eqlimina de aqui la validacion slug
            'email' => $request->email,
            'password' => $request->password
            // 'password' => Hash::make($request->password) hashear password en versiones inferiores
        ]);

        // autenticar el usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // 2da forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // redireccionar al usuario
        return Redirect()->route('posts.index');

    }

}
