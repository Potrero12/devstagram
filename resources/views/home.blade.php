@extends('layout.app')

@section('titulo')
    Principal
@endsection

@section('contenido')
    {{-- <x-listar-post> Ejemplo de componentes + slots
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>

        <h1>Mostrando Post desde slots </h1>
    </x-listar-post> --}}

    <x-listar-post :posts="$posts" />


@endsection
