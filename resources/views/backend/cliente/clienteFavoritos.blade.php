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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($favoritos->count() > 0)

        <div class="row g-4">

            @foreach($favoritos as $producto)

                <div class="col-md-4 col-lg-3">

                    <div class="card producto-card h-100">

                        {{-- FAVORITO --}}
                        <form action="{{ route('favoritos.toggle', $producto->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-favorito" title="Quitar de favoritos">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>

                        {{-- IMAGEN --}}
                        <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">

                        <div class="card-body">

                            {{-- NOMBRE --}}
                            <h5 class="card-title">
                                {{ $producto->nombre }}
                            </h5>

                            {{-- PRECIO --}}
                            <p class="precio">
                                ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                            </p>

                            {{-- ACCIONES DEL PRODUCTO --}}
                            <div class="acciones-producto d-flex gap-2 align-items-stretch">

                                <a href="{{ route('producto.mostrar', $producto->id) }}"
                                   id="btn-vermas-{{ $producto->id }}"
                                   class="btn-vermas w-100 d-flex align-items-center justify-content-center m-0">
                                   Ver más
                                </a>

                                {{-- VALIDACIÓN DE STOCK --}}
                                @if($producto->stock_actual > 0)
                                    
                                    <button type="button" class="btn btn-carrito w-100 d-flex align-items-center justify-content-center m-0" id="btn-falso-{{ $producto->id }}" onclick="mostrarCantidad({{ $producto->id }})">
                                        <i class="bi bi-cart-plus me-1"></i> Agregar
                                    </button>
                                    
                                    <form action="{{ route('carrito.agregar') }}" method="POST" id="form-carrito-{{ $producto->id }}" class="d-none w-100 m-0">
                                        @csrf 
                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                                        <div class="d-flex align-items-center justify-content-between gap-1 w-100 h-100">
                                            
                                            <button type="button" class="btn btn-sm btn-carrito px-2" onclick="cancelarCantidad({{ $producto->id }})" title="Cancelar">
                                                <i class="bi bi-x-lg"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-cantidad px-2" onclick="decrementarCatalogo({{ $producto->id }})">
                                                <i class="bi bi-dash"></i>
                                            </button>

                                            <input type="text" name="cantidad" id="input-cant-{{ $producto->id }}" value="1" class="form-control form-control-sm text-center px-1 flex-grow-1" readonly>

                                            <button type="button" class="btn btn-sm btn-cantidad px-2" onclick="incrementarCatalogo({{ $producto->id }}, {{ $producto->stock_actual }})">
                                                <i class="bi bi-plus"></i>
                                            </button>

                                            <button type="submit" class="btn btn-carrito btn-sm px-2 m-0" title="Confirmar">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </div>
                                    </form>

                                @else
                                    <button type="button" class="btn btn-agregar-carrito w-100 d-flex align-items-center justify-content-center m-0" disabled>
                                        <i class="bi bi-cart-x me-1"></i> Sin stock
                                    </button>
                                @endif

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
                <h4 class="texto-bienvenida mt-3">No tenés productos favoritos</h4>
                <p class="panel-subtitulo text-muted mb-3">Agregá productos a favoritos desde el catálogo.</p>
                <a href="{{ route('catalogo') }}" class="btn btn-catalogo">Ir al catálogo</a>
            </div>
        </div>

    @endif

</div>

<div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="modal-body admin-subtitulo">
                <i class="bi bi-check-circle-fill text-success mb-3" style="font-size: 4rem;"></i>
                <h4 class="fw-bold mb-2">¡Producto agregado!</h4>
                <p class="text-muted">El artículo se añadió a tu carrito correctamente.</p>
                <div class="mt-4 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-catalogo" data-bs-dismiss="modal">Seguir mirando</button>
                    <a href="{{ route('cliente.carrito') }}" class="btn btn-carrito">Ir a mi carrito</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarCantidad(id) {
        let btnFalso = document.getElementById('btn-falso-' + id);
        let btnVerMas = document.getElementById('btn-vermas-' + id);
        let formCarrito = document.getElementById('form-carrito-' + id);

        if (btnFalso) btnFalso.classList.add('d-none');
        if (btnVerMas) btnVerMas.classList.add('d-none'); // Si no existe, lo ignora
        if (formCarrito) formCarrito.classList.remove('d-none');
    }

    function cancelarCantidad(id) {
        let formCarrito = document.getElementById('form-carrito-' + id);
        let btnFalso = document.getElementById('btn-falso-' + id);
        let btnVerMas = document.getElementById('btn-vermas-' + id);
        let inputCant = document.getElementById('input-cant-' + id);

        if (formCarrito) formCarrito.classList.add('d-none');
        if (btnFalso) btnFalso.classList.remove('d-none');
        if (btnVerMas) btnVerMas.classList.remove('d-none');
        if (inputCant) inputCant.value = 1;
    }

    function incrementarCatalogo(id, maxStock) {
        let input = document.getElementById('input-cant-' + id);
        if (input) {
            let val = parseInt(input.value);
            if (val < maxStock) {
                input.value = val + 1;
            }
        }
    }

    function decrementarCatalogo(id) {
        let input = document.getElementById('input-cant-' + id);
        if (input) {
            let val = parseInt(input.value);
            if (val > 1) {
                input.value = val - 1;
            }
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