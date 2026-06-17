@extends('plantilla') 
@section('contenido')

<title>Catalogo</title>

<div class="container mt-3 text-center">
    <p class="titulo-bienvenida">
        Bienvenido a Nuestro Catalogo!!
    </p>
    <p class="texto-bienvenida">
        Aca vas a poder ver todos los productos que tenemos para vos!
    </p>
</div>

<!--Filtros del catalogo--->
<div class="container mt-4">
    <div class="filtros-catalogo">

        <a href="{{ route('catalogo') }}"
        class="btn-filtro {{ request()->routeIs('catalogo') ? 'activo' : '' }}">
            Todas
        </a>

        @foreach($categorias as $categoria)

            <a href="{{ route('catalogo.categoria', $categoria->id) }}"
            class="btn-filtro {{ request()->route('id') == $categoria->id ? 'activo' : '' }}">
                {{ $categoria->nombre }}
            </a>

        @endforeach

    </div>
</div>

<div class="container mt-4 mb-5">
    <div class="row catalogo row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        
    <!--Mostrar todos los productos disponibles--->
        @foreach($productos as $producto)
            <div class="col">
                <div class="card producto-card h-100">

                        <!--Si es cliente dar la opcion de agregar producto como favorito--->
                        @auth
                        @if(auth()->user()->rol?->nombre === 'cliente')
                            <form action="{{ route('favoritos.toggle', $producto->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-favorito">
                                    <i class="bi {{ in_array($producto->id, $favoritos) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                </button>
                            </form>
                        @endif
                    @endauth

                    <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $producto->nombre }}
                        </h5>

                        <p class="precio">
                            ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                        </p>

                        <div class="acciones-producto">
                        <a href="{{ route('producto.mostrar', $producto->id) }}" id="btn-vermas-{{ $producto->id }}" class="btn btn-vermas">
                        Ver Más
                        </a>
                    
                    <!--Si es cliente mostrar la opcion de agregar al carrito--->
                    @auth
                        @if(Auth::user()->rol->nombre === 'cliente')
                        <button type="button" class="btn btn-carrito" id="btn-falso-{{ $producto->id }}" onclick="mostrarCantidad({{ $producto->id }})">
                        <i class="bi bi-cart-plus"></i> Agregar
                        </button>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="btn btn-carrito text-decoration-none">
                        <i class="bi bi-cart-plus"></i> Agregar
                        </a>
                    @endauth
                            <!--Agrega productos al carrito usando la ruta carrito.agregar (CarritoController)--->
                            <form action="{{ route('carrito.agregar') }}" method="POST" id="form-carrito-{{ $producto->id }}" class="d-none w-100">
                                @csrf 
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                                <div class="d-flex align-items-center justify-content-center gap-1 w-100">
                                    
                                    <button type="button" class="btn btn-sm btn-carrito px-2" onclick="cancelarCantidad({{ $producto->id }})" title="Cancelar">
                                        <i class="bi bi-x-lg"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-cantidad px-2" onclick="decrementarCatalogo({{ $producto->id }})">
                                        <i class="bi bi-dash"></i>
                                    </button>

                                    <input type="text" name="cantidad" id="input-cant-{{ $producto->id }}" value="1" class="form-control form-control-sm text-center px-1" style="width: 45px;" readonly>

                                    <button type="button" class="btn btn-sm btn-cantidad px-2" onclick="incrementarCatalogo({{ $producto->id }}, {{ $producto->stock_actual }})">
                                        <i class="bi bi-plus"></i>
                                    </button>

                                    <button type="submit" class="btn btn-carrito btn-sm px-2 m-0" title="Confirmar">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
<!--Modal que aparece en pantalla luego de agregar un producto al carrito--->
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

<script>
    function mostrarCantidad(id) {
        document.getElementById('btn-falso-' + id).classList.add('d-none');
        document.getElementById('btn-vermas-' + id).classList.add('d-none');
        document.getElementById('form-carrito-' + id).classList.remove('d-none');
    }

    function cancelarCantidad(id) {
        document.getElementById('form-carrito-' + id).classList.add('d-none');
        document.getElementById('btn-falso-' + id).classList.remove('d-none');
        document.getElementById('btn-vermas-' + id).classList.remove('d-none');
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