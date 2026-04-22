@extends('plantilla') 
@section('contenido')

<title>categoria-peluches</title>

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
                <img src="{{ asset('img/catalogo/peluches/peluche-osito.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Peluche Osito</h5>
                    <p class="card-text">$17.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/peluches/peluche-conejito.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Peluche Conejito</h5>
                    <p class="card-text">$15.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/peluches/peluche-ranita.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Peluche Ranita</h5>
                    <p class="card-text">$15.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/peluches/peluche-dino.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Peluche Dinosaurio</h5>
                    <p class="card-text">$16.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection