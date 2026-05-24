<!--vista del sector de inicio-->
@extends('plantilla')
@section('contenido')

<!--titulo de la pagina-->
<title> Inicio </title>

<!--carrusel principal del inicio -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('img/carrusel-principal/c1.jpg') }}" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/carrusel-principal/c2.jpg') }}" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/carrusel-principal/c3.jpg') }}" class="d-block w-100">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>

<!--texto de bienvenida-->
<div class="container mt-5 text-center">
    <h2 class="titulo-bienvenida">¡Bienvenidos a TN Toys!</h2>
    <p class="texto-bienvenida">
        Encontra en Nuestra Tienda...
    </p>
</div>

<!--contenedor para las cards del inicio -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-4">

            <!-- primer card -->
            <div class="card h-100">
                <div class="row g-0">
                    <!--carrusel de la card -->
                    <div class="col-4">
                        <div id="carruselNiños" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel1/dinoC1.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel1/barbC1.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel1/hwC1.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--texto de la card -->
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title">Juguetes Para Niños!</h5>
                            <p class="card-text">En TN Toys vas a encontrar todo para hacer felices a los más pequeños, desde mágicos castillos de princesas hasta divertidas pistas de autos</p>
                            <a href="{{ url('categorias/juguetes') }}" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <!-- segunda card -->
            <div class="card h-100">
                <div class="row g-0">
                    <!-- carrusel de la card -->
                    <div class="col-4">
                        <div id="carruselBebes" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel2/bebeC2.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel2/caminadorC2.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel2/famC2.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- texto de la card -->
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title">Juguetes De Primera Infancia!</h5>
                            <p class="card-text">En TN Toys encontrá los mejores juguetes didácticos para bebés, ideales para estimular sus sentidos y desarrollar sus habilidades.</p>
                            <a href="{{ url('categorias/primera-infancia') }}" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <!--tercera card-->
            <div class="card h-100">
                <div class="row g-0">
                    <!--carrusel de la card-->
                    <div class="col-4">
                        <div id="carruselJuegos" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel3/batallaNavalC3.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel3/ajeC3.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel3/jengC3.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--texto de la card-->
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title">Juegos De Mesa!</h5>
                            <p class="card-text">En TN Toys encontrá una gran variedad de juegos de mesa ideales para compartir en familia o con amigos, divertirse y crear momentos inolvidables.</p>
                            <a href="{{ url('categorias/juegos-de-mesa') }}" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <!--cuarta card-->
            <div class="card h-100">
                <div class="row g-0">
                    <!--carrusel de la card-->
                    <div class="col-4">
                        <div id="carruselFiguras" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel4/leviC4.jpg') }}" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel4/batC4.jpg') }}" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel4/fpC4.jpg') }}" class="d-block w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--texto de la card-->
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title">Figuras de Colección</h5>
                            <p class="card-text">En TN Toys descubrí figuras de colección de tus personajes favoritos, ideales para fans que buscan sumar piezas únicas y especiales a su colección.</p>
                            <a href="{{ url('categorias/fig-coleccionables') }}" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <!--quinta card-->
            <div class="card h-100">
                <div class="row g-0">
                    <!--carrusel de la card-->
                    <div class="col-4">
                        <div id="carruselLegos" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel5/lego-cityC5.jpg') }}" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel5/lego-classicC5.jpg') }}" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel5/lego-speedC5.jpg') }}" class="d-block w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--texto de la card-->
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title">Legos</h5>
                            <p class="card-text">En TN Toys vas a encontrar los mejores sets de construcción para chicos y también para los más grandes que disfrutan crear y coleccionar.</p>
                            <a href="{{ url('categorias/legos') }}" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <!--sexta card-->
            <div class="card h-100">
                <div class="row g-0">
                    <!--carrusel de la card-->
                    <div class="col-4">
                        <div id="carruselPeluches" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel6/kittyC6.jpg') }}" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel6/ositoC6.jpg') }}" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/carruseles-inicio/carrusel6/stichC6.jpg') }}" class="d-block w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--texto de la card-->
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title">Peluches</h5>
                            <p class="card-text">En TN Toys vas a encontrar los peluches más suaves y adorables para acompañar a los más pequeños en cada momento.</p>
                            <a href="{{ url('categorias/peluches') }}" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--texto y boton de catalogo-->
<div class="container mt-3 mb-5 text-center">
    <p class="texto-bienvenida">
        Y Mucho Mas!!...
    </p>
    <a href="{{ url('catalogo') }}" class="btn btn-catalogo mt-auto">VER CATALOGO COMPLETO</a>
</div>

@endsection