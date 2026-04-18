@extends('plantilla') 
@section('contenido')

<title>categoria-legos</title>

<div class= "container mt-3">
    <div class="dropdown">
        <button class="btn btn-bcategoria dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                CATEGORIAS
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ url('catalogo') }}">Quitar Filtro</a></li>
            <li><a class="dropdown-item" href="{{ url('categorias/juguetes') }}">Juguetes</a></li>
            <li><a class="dropdown-item" href="{{ url('categorias/primera-infancia') }}">Primera Infancia</a></li>
            <li><a class="dropdown-item" href="{{ url('categorias/juegos-de-mesa') }}">Juegos de Mesa</a></li>
            <li><a class="dropdown-item" href="{{ url('categorias/fig-coleccionables') }}">Figuras Coleccionables</a></li>
            <li><a class="dropdown-item" href="{{ url('categorias/legos') }}">Legos</a></li>
            <li><a class="dropdown-item" href="{{ url('categorias/peluches') }}">Peluches</a></li>
        </ul>
    </div>
</div>

<div class="container mt-4">
    <div class="row catalogo row-cols-1 row-cols-md-3 row-cols-lg-5 g-4">
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/legos/lego-est-policia.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Lego Est. de Policia</h5>
                    <p class="card-text">$20.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/legos/lego-est-bomberos.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Lego Est. de Bomberos</h5>
                    <p class="card-text">$20.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/legos/lego-helicoptero.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Lego Helicoptero</h5>
                    <p class="card-text">$20.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection