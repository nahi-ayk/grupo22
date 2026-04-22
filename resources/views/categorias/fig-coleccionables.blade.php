@extends('plantilla')
@section('contenido')

<title> categoria-fig-coleccionables </title>

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
                <img src="{{ asset('img/catalogo/figuras-colec/fig-iron-man.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Funko Pop Iron Man</h5>
                    <p class="card-text">$65.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/figuras-colec/fig-batman.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Funko Pop Batman</h5>
                    <p class="card-text">$60.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>           

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/figuras-colec/fig-colec-batman.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Fig. Colec. Batman</h5>
                    <p class="card-text">$90.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/figuras-colec/fig-spider-man.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Funko Pop Spider-Man</h5>
                    <p class="card-text">$60.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/figuras-colec/fig-flash.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Funko Pop Flash</h5>
                    <p class="card-text">$60.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection