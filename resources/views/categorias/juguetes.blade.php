<!--vista para categoria de juguetes-->
<!--es un copia y pega de catalogo con los productos de esta categoria-->
<!--alternativa ante la ausencia de base de datos-->
@extends('plantilla')
@section('contenido')

<title> categoria-juguetes </title>

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
                <img src="{{ asset('img/catalogo/juguetes/j-barbie-unicornio.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Barbie Unicornio</h5>
                    <p class="card-text">$80.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juguetes/j-barbie-doctora.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Barbie Doctora</h5>
                    <p class="card-text">$60.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juguetes/j-barbie-maestra.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Barbie Maestra</h5>
                    <p class="card-text">$65.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juguetes/j-barbie-ken.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Ken Surfista</h5>
                    <p class="card-text">$40.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juguetes/j-pista-hw.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Pista Hot Wheels</h5>
                    <p class="card-text">$120.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juguetes/j-auto-policia.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Auto de Policia</h5>
                    <p class="card-text">$18.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juguetes/j-cam-bomberos.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Camion de Bomberos</h5>
                    <p class="card-text">$22.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juguetes/j-hw.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Hot Wheel</h5>
                    <p class="card-text">$5.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juguetes/j-pistola-dardos.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Pistola de Dardos X-Shoot</h5>
                    <p class="card-text">$23.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

@endsection