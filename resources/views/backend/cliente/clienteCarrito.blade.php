@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Mi Carrito</title>
<div class="container my-4">
    <h2 class="mb-4">Mi Carrito de Compras</h2>

    <!---Carrito--->
    @forelse($items as $item)
        <!---Si hay productos, abrimos la tabla solo la primera vez ---> 
        @if ($loop->first)
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
        @endif

        <tr>
            <td>{{ $item->producto->nombre }}</td>
            <td>{{ $item->cantidad }}</td>
            <td>${{ number_format($item->precio_unitario, 2) }}</td>
            <td>${{ number_format($item->subtotal, 2) }}</td>
            <td>
                <!--Boton para eliminar un solo item del carrito--->
                <form method="POST" action="{{ route('carrito.eliminar', $item->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>

        <!--- Si es el último producto, cerramos la tabla y mostramos las acciones de cierre --->
        @if ($loop->last)
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
                <div>
                    <!--Total del pedido--->
                    <h4>Total: ${{ number_format($carrito->total, 2) }}</h4>

                    <!---Formulario para VACIAR EL CARRITO (Limpia los PedidoDetalle) --->
                    <form method="POST" action="{{ route('carrito.vaciar') }}" class="mt-2" onsubmit="return confirm('¿Estás seguro de que deseas vaciar todo el carrito?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash3"></i> Vaciar Carrito
                        </button>
                    </form>
                </div>
                
                <!----- Opciones de entrega --->
                <div class="d-flex gap-2">
                    <!-- Opción 1: Retiro en sucursal (Compra directa) -->
                    <form method="POST" action="{{ route('carrito.confirmar') }}">
                        @csrf
                        <input type="hidden" name="tipo_entrega" value="retiro">
                        <button type="submit" class="btn btn-primary">Retirar en Sucursal</button>
                    </form>

                    <!-- Opción 2: Botón que dispara el Formulario de Envío (Modal) -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEnvio">
                        Solicitar Envío a Domicilio
                    </button>
                </div>
            </div>
        @endif

    @empty
        <!--- CARD: Este bloque se ejecuta ÚNICAMENTE si el pedido no tiene detalles (productos) --->
        <div class="card text-center p-5 shadow-sm">
            <div class="card-body">
                <div class="mb-3 text-muted" style="font-size: 3rem;">
                    <i class="bi bi-cart-x"></i>
                </div>
                <h3 class="card-title">Tu carrito está vacío</h3>
                <p class="card-text text-muted text-center">Parece que aún no has agregado ningún producto a tu pedido.</p>
                <a href="{{ url('/catalogo') }}" class="btn btn-primary mt-3">Ir al catàlogo</a>
            </div>
        </div>
    @endforelse
</div>

<!-- MODAL: FORMULARIO DE ENVÍO -->
@if(count($items) > 0)
<div class="modal fade" id="modalEnvio" tabindex="-1" aria-labelledby="modalEnvioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEnvioLabel">Datos para el Envío</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Este formulario procesa la compra enviando los datos para la tabla 'envios' -->
            <form method="POST" action="{{ route('carrito.confirmar') }}">
                @csrf
                <input type="hidden" name="tipo_entrega" value="envio">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección de entrega</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required placeholder="Calle y número, Piso/Depto">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="provincia" class="form-label">Provincia</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" required placeholder="Ej: Chaco">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="localidad" class="form-label">Localidad</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" required placeholder="Ej: Resistencia">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="codigo_postal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required placeholder="Ej: 3500">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Confirmar y pagar envío</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection