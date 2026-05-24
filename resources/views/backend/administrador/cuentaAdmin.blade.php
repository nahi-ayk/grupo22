@extends('plantilla')
@section('contenido')

<title>administrador</title>

<h2>HOLA ADMIN</h2>

@auth
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">
            Cerrar sesión
        </button>
    </form>
@endauth

@endsection