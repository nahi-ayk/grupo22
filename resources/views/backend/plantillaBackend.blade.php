@extends('plantilla')
@section('contenido')

<head>
    <title>@yield('titulo', 'Panel de Control - Mi Juguetería')</title>
</head>

<div class="layout-backend">

    <!-- SIDEBAR -->
    @include('partes.sidebar')

    <!-- CONTENIDO DINAMICO -->
    <main class="contenido-backend">
        @yield('contenidoBackend')
    </main>

</div>

@endsection