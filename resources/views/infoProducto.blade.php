@extends('plantilla')

@section('contenido')

<title>{{ $producto->nombre }}</title>

<div class="container py-5">

    <div class="producto-detalle-card">

        <a href="{{ route('catalogo') }}" class="btn-volver-detalle">
            <i class="bi bi-arrow-left"></i>
            Volver al catálogo
        </a>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mt-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5 align-items-center mt-0">

            <div class="col-lg-5">
                <div class="producto-imagen-container">
                    <img src="{{ asset($producto->imagen) }}"
                        alt="{{ $producto->nombre }}"
                        class="producto-detalle-img">
                </div>
            </div>

            <div class="col-lg-7">
                <div class="producto-info">

                    <div class="d-flex justify-content-between align-items-start">
                        <h1 class="producto-titulo">
                            {{ $producto->nombre }}
                        </h1>

                        @auth
                            @if(Auth::user()->rol?->nombre === 'cliente')
                                <form action="{{ route('favoritos.toggle', $producto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-favorito-detalle">
                                        <i class="bi {{ in_array($producto->id, $favoritos) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
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

                        @if($producto->stock_actual > 0)
                            
                            @auth
                                @if(Auth::user()->rol?->nombre === 'cliente')
                                    <button type="button" class="btn btn-agregar-carrito w-100" id="btn-falso-{{ $producto->id }}" onclick="mostrarCantidad({{ $producto->id }})">
                                        <i class="bi bi-cart-plus"></i> Agregar al carrito
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-agregar-carrito w-100 text-decoration-none text-center">
                                    <i class="bi bi-cart-plus"></i> Agregar al carrito
                                </a>
                            @endauth

                            @auth
                                @if(Auth::user()->rol?->nombre === 'cliente')
                                    <form action="{{ route('carrito.agregar') }}" method="POST" id="form-carrito-{{ $producto->id }}" class="d-none w-100 mt-2">
                                        @csrf 
                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                                        <div class="d-flex align-items-center justify-content-start gap-2 w-100">
                                            
                                            <button type="button" class="btn btn-sm btn-carrito px-2" onclick="cancelarCantidad({{ $producto->id }})" title="Cancelar">
                                                <i class="bi bi-x-lg"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-cantidad px-2" onclick="decrementarCatalogo({{ $producto->id }})">
                                                <i class="bi bi-dash"></i>
                                            </button>

                                            <input type="text" name="cantidad" id="input-cant-{{ $producto->id }}" value="1" class="form-control text-center fw-bold" style="width: 60px;" readonly>

                                            <button type="button" class="btn btn-sm btn-cantidad px-2" onclick="incrementarCatalogo({{ $producto->id }}, {{ $producto->stock_actual }})">
                                                <i class="bi bi-plus"></i>
                                            </button>

                                            <button type="submit" class="btn btn-carrito btn-sm px-2 m-0" title="Confirmar">
                                                <i class="bi bi-check-lg me-1"></i>
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            @endauth

                        @else
                            <button type="button" class="btn btn-secondary w-100 py-2 fw-bold" disabled>
                                <i class="bi bi-cart-x me-1"></i> Producto sin stock
                            </button>
                        @endif

                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body admin-subtitulo">
                    <i class="bi bi-check-circle-fill text-success mb-3" style="font-size: 4rem;"></i>
                    <h4 class="fw-bold mb-2">¡Producto agregado!</h4>
                    <p class="text-muted">El artículo se añadió a tu carrito correctamente.</p>
                    <div class="mt-4 d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-catalogo" data-bs-dismiss="modal">Seguir comprando</button>
                        <a href="{{ route('cliente.carrito') }}" class="btn btn-carrito">Ir a mi carrito</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function mostrarCantidad(id) {
        document.getElementById('btn-falso-' + id).classList.add('d-none');
        document.getElementById('form-carrito-' + id).classList.remove('d-none');
    }

    function cancelarCantidad(id) {
        document.getElementById('form-carrito-' + id).classList.add('d-none');
        document.getElementById('btn-falso-' + id).classList.remove('d-none');
        document.getElementById('input-cant-' + id).value = 1;
    }

    function incrementarCatalogo(id, maxStock) {
        let input = document.getElementById('input-cant-' + id);
        let val = parseInt(input.value);
        if (val < maxStock) {
            input.value = val + 1;
        }
    }

    function decrementarCatalogo(id) {
        let input = document.getElementById('input-cant-' + id);
        let val = parseInt(input.value);
        if (val > 1) {
            input.value = val - 1;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            var modalExito = new bootstrap.Modal(document.getElementById('modalExito'));
            modalExito.show();
        @endif
    });
</script>

@endsection