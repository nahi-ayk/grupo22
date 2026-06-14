@extends('backend.plantillaBackend')
@section('titulo', 'Detalle Pedido #' . $pedido->numero_pedido)
@section('contenidoBackend')

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold admin-titulo">Detalle de mi Pedido #{{ $pedido->numero_pedido }}</h1>
            <p class="text-muted admin-subtitulo fs-6">
                Realizado el: {{ $pedido->created_at ? $pedido->created_at->format('d/m/Y H:i') : 'N/A' }}
            </p>
        </div>
        <a href="{{ route('cliente.compras') }}" class="btn btn-custom-colores btn-sm">
            <i class="bi bi-arrow-left"></i> Volver a mis pedidos
        </a>
    </div>

    <div class="card admin-subtitulo shadow-sm" style="transform: none !important; transition: none !important; overflow: hidden; border-radius: 12px;">
        <div class="card-header bg-white py-3 px-4">
            <h5 class="mb-0 text-secondary">Productos en el Pedido</h5>
        </div>

        @if($pedido->detalles->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-cart-x fs-1 text-muted"></i>
                <h5 class="mt-3 text-muted">
                    Estado: 
                    <span class="badge" style="background-color: #fff3cd; color: #664d03; border: 1px solid #ffe69c;">
                        <i class="bi bi-clock me-1"></i>{{ ucfirst($pedido->estado) }}
                    </span>
                </h5>
                <p class="text-muted">Este pedido no tiene productos porque aún está en estado "{{ $pedido->estado }}".</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7">
                        <tr>
                            <th class="px-4 py-3">Imagen</th>
                            <th class="px-3 py-3">Producto</th>
                            <th class="px-3 py-3">Cantidad</th>
                            <th class="px-3 py-3">Precio Unitario</th>
                            <th class="px-3 py-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedido->detalles as $detalle)
                            <tr>
                                <td class="px-4 py-2">
                                    <img src="{{ asset('img/catalogo/' . basename($detalle->producto->imagen)) }}" 
                                        alt="{{ $detalle->producto->nombre }}" 
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                </td>
                                <td class="px-3 py-3 fw-medium text-dark">
                                    {{ $detalle->producto->nombre }}
                                </td>
                                <td class="px-3 py-3">{{ $detalle->cantidad }}</td>
                                <td class="px-3 py-3">${{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                                <td class="px-3 py-3 fw-bold text-success">${{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-light p-4">
                <div class="text-end mb-4 pb-3 border-bottom">
                    <h5 class="mb-0">Total: ${{ number_format($pedido->total, 2, ',', '.') }}</h5>
                </div>
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <h6 class="text-secondary fw-bold text-uppercase small">Método de Pago</h6>
                        @if(strtolower($pedido->estado) == 'carrito')
                            <p class="mb-0 text-secondary fw-medium"><i class="bi bi-wallet2"></i> A definir al finalizar compra</p>
                        @else
                            <p class="mb-0 fw-medium">{{ $pedido->metodoPago->descripcion ?? 'No especificado' }}</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-secondary fw-bold text-uppercase small">Tipo de Entrega</h6>
        
                        @if(strtolower($pedido->estado) == 'carrito')
                            {{-- MODO CARRITO: Ocultamos el envío y mostramos un texto neutral --}}
                            <p class="mb-0 text-secondary fw-medium"><i class="bi bi-box-seam"></i> A definir al finalizar compra</p>
                        @else
                            {{-- MODO COMPRA FINALIZADA: Comprobamos si existe un registro en la tabla envios --}}
                            @if($pedido->envio)
                                <p class="mb-0 text-success fw-medium"><i class="bi bi-truck"></i> Envío a Domicilio</p>
                                <small class="text-muted d-block mt-1">
                                    <i class="bi bi-geo-alt"></i> {{ $pedido->envio->provincia }}, {{ $pedido->envio->localidad }} | CP: {{ $pedido->envio->codigo_postal }}<br>
                                    {{ $pedido->envio->direccion }}
                                </small>
                            @else
                                <p class="mb-0 text-success fw-medium"><i class="bi bi-shop"></i> Retiro en Sucursal</p>
                                <small class="text-muted d-block mt-1">Te avisaremos cuando esté listo para retirar.</small>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection