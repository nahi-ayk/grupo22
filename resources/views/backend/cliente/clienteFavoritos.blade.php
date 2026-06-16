@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Mis Favoritos</title>

<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="admin-titulo">
            Mis Favoritos
        </h2>

        <p class="admin-subtitulo">
            Productos que guardaste como favoritos
        </p>
    </div>

    @if($favoritos->count() > 0)

        <div class="row g-4">

            @foreach($favoritos as $producto)

                <div class="col-md-4 col-lg-3">

                    <div class="card producto-card">

                        {{-- FAVORITO --}}
                        <form action="{{ route('favoritos.toggle', $producto->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-favorito">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>

                        {{-- IMAGEN --}}
                        <img src="{{ asset($producto->imagen) }}"
                        class="card-img-top"
                        alt="{{ $producto->nombre }}">

                        <div class="card-body">

                            {{-- NOMBRE --}}
                            <h5 class="card-title">
                                {{ $producto->nombre }}
                            </h5>

                            {{-- PRECIO --}}
                            <div class="precio">
                                ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                            </div>

                            {{-- BOTONES --}}
                            <div class="acciones-producto">

                                <a href="{{ route('producto.mostrar', $producto->id) }}"
                                   class="btn-vermas">
                                    Ver más
                                </a>

                                <form action="{{ route('carrito.agregar', $producto->id) }}"
                                      method="POST"
                                      class="flex-fill">
                                    @csrf

                                    <button type="submit"
                                            class="btn-carrito w-100">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="mi-cuenta-card">
            <div class="card-body text-center">

                <i class="bi bi-heart fs-1 text-danger"></i>

                <h4 class="texto-bienvenida mt-3">
                    No tenés productos favoritos
                </h4>

                <p class="panel-subtitulo text-muted mb-3">
                    Agregá productos a favoritos desde el catálogo.
                </p>

                <a href="{{ route('catalogo') }}"
                   class="btn btn-catalogo">
                    Ir al catálogo
                </a>

            </div>
        </div>

    @endif

</div>

@endsection