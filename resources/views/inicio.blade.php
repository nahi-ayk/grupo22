<!--VISTA DE INICIO-->
@extends('plantilla')
@section('contenido')

<title>Inicio</title>

<!--CARRUSEL PRINCIPAL-->
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

    <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>

<!--BIENVENIDA-->
<div class="container py-5 text-center">

    <h2 class="titulo-bienvenida">
        ¡Bienvenidos a TN Toys!
    </h2>

    <p class="texto-bienvenida">
        Descubrí juguetes, juegos de mesa, figuras coleccionables
        y mucho más para todas las edades.
    </p>

</div>

<!--CATEGORIAS-->
<div class="container mb-5">

    <h3 class="text-center mb-5 texto-bienvenida">
        Explorá nuestras categorías
    </h3>

    <div class="categorias-slider">

        <div class="categorias-track">

            @foreach($categorias as $categoria)

                <a href="{{ route('catalogo.categoria', $categoria->id) }}"
                   class="categoria-item">

                    <img src="{{ asset($categoria->imagen) }}"
                         alt="{{ $categoria->nombre }}">

                    <span>
                        {{ $categoria->nombre }}
                    </span>

                </a>

            @endforeach

            @foreach($categorias as $categoria)

                <a href="{{ route('catalogo.categoria', $categoria->id) }}"
                   class="categoria-item">

                    <img src="{{ asset($categoria->imagen) }}"
                         alt="{{ $categoria->nombre }}">

                    <span>
                        {{ $categoria->nombre }}
                    </span>

                </a>

            @endforeach

        </div>

    </div>

</div>

<!--BOTON CATALOGO-->
<div class="container text-center mb-5">

    <p class="texto-bienvenida">
        Encontrá todo lo que buscás en nuestro catálogo!
    </p>

    <a href="{{ route('catalogo') }}"
       class="btn btn-catalogo">
        VER CATÁLOGO COMPLETO
    </a>

</div>

<!--FAVORITOS-->
<div class="container my-5">

    <h2 class="titulo-bienvenida text-center mx-auto">
        Los favoritos de nuestros clientes!
    </h2>

    <p class="texto-bienvenida text-center mb-5">
        Los productos que más gustan a nuestra comunidad.
    </p>

    @if($favoritos->count() >= 3)

    <div class="row g-4">

        <!--PRODUCTO PRINCIPAL-->
        <div class="col-lg-8">

            <div class="producto-card h-100">

                <img src="{{ asset($favoritos[0]->imagen) }}"
                     class="card-img-top favorito-principal-img"
                     alt="{{ $favoritos[0]->nombre }}">

                <div class="card-body text-center">

                    <h3 class="card-title">
                         {{ $favoritos[0]->nombre }}
                    </h3>

                    <p class="precio">
                        ${{ number_format($favoritos[0]->precio_venta,0,',','.') }}
                    </p>

                    <a href="{{ route('producto.mostrar', $favoritos[0]->id) }}"
                       class="btn btn-catalogo">
                        Ver producto
                    </a>

                </div>

            </div>

        </div>

        <!--LATERAL-->
        <div class="col-lg-4">

            <div class="producto-card favorito-card mb-4">

                <img src="{{ asset($favoritos[1]->imagen) }}"
                     class="card-img-top favorito-secundario-img"
                     alt="{{ $favoritos[1]->nombre }}">

                <div class="card-body text-center">

                    <h5 class="card-title">
                        {{ $favoritos[1]->nombre }}
                    </h5>

                    <a href="{{ route('producto.mostrar', $favoritos[1]->id) }}"
                       class="btn btn-catalogo">
                        Ver producto
                    </a>

                </div>

            </div>

            <div class="producto-card favorito-card">

                <img src="{{ asset($favoritos[2]->imagen) }}"
                     class="card-img-top favorito-secundario-img"
                     alt="{{ $favoritos[2]->nombre }}">

                <div class="card-body text-center">

                    <h5 class="card-title">
                        {{ $favoritos[2]->nombre }}
                    </h5>

                    <a href="{{ route('producto.mostrar', $favoritos[2]->id) }}"
                       class="btn btn-catalogo mt-3">
                        Ver producto
                    </a>

                </div>

            </div>

        </div>

    </div>

    @endif

</div>

<!--TUTORIAL PEQUEÑO-->
<div class="container text-center mb-5">

    <h2 class="titulo-bienvenida text-center mx-auto mb-3">
        Pequeño Tutorial!
    </h2>

    <p class="texto-bienvenida text-center mb-3">
        Aprende a comprar en nuestra tienda...
    </p>

    <img src="{{ asset('img/tuto.jpg') }}"
         alt="Cómo comprar en TN Toys"
         class="img-fluid mb-4 tutorial-img">

    <a href="/comercializacion"
       class="btn btn-catalogo">
        CONOCÉ CÓMO TRABAJAMOS
    </a>

</div>

@endsection