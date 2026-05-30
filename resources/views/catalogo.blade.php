<!-- vista de sector CATALOGO -->
@extends('plantilla') 
@section('contenido')

<!--titulo de pagina-->
<title>Catalogo</title>

<!--titulos del cuerpo-->
<div class= "container mt-3 text-center">
    <p class= "titulo-bienvenida">
        Bienvenido a Nuestro Catalogo!!
    </p>
    <p class= "texto-bienvenida">
        Aca vas a poder ver todos los productos que tenemos para vos!
    </p>
</div>

<!--boton de categorias-->
<div class="container mt-4">

    <div class="filtros-catalogo">

        <a href="{{ route('catalogo') }}"
        class="btn-filtro">
            Todas
        </a>

        @foreach($categorias as $categoria)

            <a href="{{ route('catalogo.categoria', $categoria->id) }}"
            class="btn-filtro">

                {{ $categoria->nombre }}

            </a>

        @endforeach

    </div>

</div>

<!--cards del catalogo-->
<div class="container mt-4 mb-5">
    <div class="row catalogo row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">

        @foreach($productos as $producto)

        <div class="col">
            <div class="card producto-card h-100">

                @if(auth()->check())

                    <form action="{{ route('favoritos.toggle', $producto->id) }}"
                        method="POST">

                        @csrf

                        <button type="submit" class="btn-favorito">

                            <i class="bi {{ in_array($producto->id, $favoritos) ? 'bi-heart-fill' : 'bi-heart' }}"></i>

                        </button>

                    </form>

                @else

                    <a href="{{ url('/login') }}" class="btn-favorito">

                        <i class="bi bi-heart"></i>

                    </a>

                @endif

                <img src="{{ asset($producto->imagen) }}"
                class="card-img-top"
                    alt="{{ $producto->nombre }}">
                <div class="card-body">

                    <h5 class="card-title">
                        {{ $producto->nombre }}
                    </h5>

                    <p class="precio">
                        ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                    </p>

                    <div class="acciones-producto">

                        <a href="{{ route('producto.mostrar', $producto->id) }}"
                        class="btn btn-vermas">
                            Ver Más
                        </a>

                        <button class="btn btn-carrito">
                            <i class="bi bi-cart-plus"></i>
                            Agregar
                        </button>

                    </div>

                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>

@endsection