@extends('plantilla')
@section('contenido')

<div class="layout-backend">

    <!-- SIDEBAR -->
    @include('partes.sidebar')

    <!-- CONTENIDO DINAMICO -->
    <main class="contenido-backend">
        @yield('contenidoBackend')
    </main>

</div>

@endsection