<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post){

        // validar
        $this->validate($request, [
            'comentario' => ['required', 'max:255']
        ]);

        // almacenar
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);


        // imprimiar mensaje
        return back()->with('mensaje', 'Comentario realizado correctamente');

    }
}
