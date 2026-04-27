@extends('plantilla') 
@section('contenido')

<title>Catalogo</title>

<div class= "container mt-3 text-center">
    <p class= "titulo-bienvenida">
        Bienvenido a Nuestro Catalogo!!
    </p>
    <p class= "texto-bienvenida">
        Aca vas a poder ver todos los productos que tenemos para vos!
    </p>
</div>

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
                <img src="{{ asset('img/catalogo/juegos-de-mesa/jm-ajedrez-madera.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Ajedrez de Madera - Nupro</h5>
                    <p class="card-text">$20.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juegos-de-mesa/jm-ajedrez-plastico.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Ajedrez de Plastico - Ruibal</h5>
                    <p class="card-text">$15.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juegos-de-mesa/jm-damas.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Damas - Ruibal</h5>
                    <p class="card-text">$17.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juegos-de-mesa/jm-domino.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Domino - Ruibal</h5>
                    <p class="card-text">$11.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juegos-de-mesa/jm-cartas-españolas.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Cartas Españolas</h5>
                    <p class="card-text">$4.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juegos-de-mesa/jm-cartas-poker.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Cartas Poker</h5>
                    <p class="card-text">$6.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juegos-de-mesa/jm-bingo.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Bingo - Ruibal</h5>
                    <p class="card-text">$50.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/juegos-de-mesa/jm-ruleta.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Juego de la Ruleta - Ruibal</h5>
                    <p class="card-text">$76.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

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

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/primeraInfancia/prim-inf-locomotora.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Locomotora Didactica - Duravit</h5>
                    <p class="card-text">$10.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/primeraInfancia/prim-inf-gimnasio.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Gimnasio Primera Inf. - Duravit</h5>
                    <p class="card-text">$25.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/primeraInfancia/prim-inf-tren.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Tren Didactico - Duravit</h5>
                    <p class="card-text">$12.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/primeraInfancia/prim-inf-torre-anillos.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Piramide de Anillos - Duravit</h5>
                    <p class="card-text">$8.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/primeraInfancia/prim-inf-barco.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Barco Flotador - Duravit</h5>
                    <p class="card-text">$9.000</p>
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
                    <h5 class="card-title">Auto Policia</h5>
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

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/legos/lego-est-policia.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Lego Est. de Policia</h5>
                    <p class="card-text">$48.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/legos/lego-est-bomberos.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Lego Est. de Bomberos</h5>
                    <p class="card-text">$53.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('img/catalogo/legos/lego-helicoptero.jpg') }}" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title">Lego Helicoptero</h5>
                    <p class="card-text">$32.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>

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