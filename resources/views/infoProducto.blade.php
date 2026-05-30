@extends('plantilla')

@section('contenido')

<title>{{ $producto->nombre }}</title>

<div class="container py-5">

    <div class="producto-detalle-card">

        <a href="{{ route('catalogo') }}"
        class="btn-volver-detalle">

            <i class="bi bi-arrow-left"></i>
            Volver al catálogo

        </a>

        <div class="row g-5 align-items-center">

            <!-- Imagen -->
            <div class="col-lg-5">

                <div class="producto-imagen-container">

                    <img src="{{ asset($producto->imagen) }}"
                         alt="{{ $producto->nombre }}"
                         class="producto-detalle-img">

                </div>

            </div>

            <!-- Información -->
            <div class="col-lg-7">

                <div class="producto-info">

                    <div class="d-flex justify-content-between align-items-start">

                        <h1 class="producto-titulo">
                            {{ $producto->nombre }}
                        </h1>

                        @if(auth()->check())

                            <form action="{{ route('favoritos.toggle', $producto->id) }}"
                                  method="POST">

                                @csrf

                                <button type="submit" class="btn-favorito-detalle">

                                    <i class="bi {{ in_array($producto->id, $favoritos) ? 'bi-heart-fill' : 'bi-heart' }}"></i>

                                </button>

                            </form>

                        @else

                            <a href="{{ url('/login') }}"
                               class="btn-favorito-detalle">

                                <i class="bi bi-heart"></i>

                            </a>

                        @endif

                    </div>

                    <p class="producto-categoria">
                        {{ $producto->categoria->nombre }}
                    </p>

                    <p class="producto-precio">
                        ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                    </p>

                    <div class="producto-descripcion">

                        <h5>Descripción</h5>

                        <p>
                            {{ $producto->descripcion }}
                        </p>

                    </div>

                    <div class="acciones-detalle">

                        <button class="btn btn-agregar-carrito">

                            <i class="bi bi-cart-plus"></i>
                            Agregar al carrito

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection