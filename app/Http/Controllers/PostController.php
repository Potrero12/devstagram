<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user){

        // trayendo los todos los post que tiene usuario logueado
        $posts = Post::where('user_id', $user->id)->paginate(20);

        // paginacion usando la relacion elocuent - se usa todo con la variable del $user

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);

    }

    public function create(){
        
        return view('posts.create');
    }

    public function store(Request $request){
        
        // validar el formulario
        $this->validate($request, [
            'titulo' => ['required', 'max:255'],
            'descripcion' => ['required'],
            'imagen' => ['required']
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        // otra forma de guardar
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // guardar usando las relaciones
        // $request->user()->posts()->create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        // redireccionar
        return redirect()->route('posts.index', auth()->user()->username);


    }

    public function show(User $user, Post $post){

        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);

    }
}
