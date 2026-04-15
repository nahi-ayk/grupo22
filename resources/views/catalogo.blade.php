@extends('plantilla')
@section('contenido')
        <title> catalogo </title>
    <body>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5">
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('img/catalogo/ajedrez.jpg') }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Ajedrez de Madera</h5>
                        <p class="card-text">$20.000</p>
                        <a href="#" class="btn btn-primary">Agregar</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection