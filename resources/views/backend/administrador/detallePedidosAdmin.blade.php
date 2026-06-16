@extends('backend.plantillaBackend')
@section('titulo', 'Admin - Pedido #' . $pedido->numero_pedido)
@section('contenidoBackend')

<div class="container my-5">

    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">
                Detalle del Pedido #{{ $pedido->numero_pedido }}
            </h1>

            <p class="panel-subtitulo">
                Cliente: {{ $pedido->usuario ? $pedido->usuario->nombre . ' ' . $pedido->usuario->apellido : 'Usuario Desconocido' }}
            </p>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-vermas-pedido">
            Volver
        </a>
    </div>

    <div class="panel-card">

        <div class="card-header bg-white py-3 px-4">
            <p class="panel-subtitulo">Productos en el Pedido</p>
        </div>

        @if($pedido->detalles->isEmpty())

            <div class="text-center py-5">
                <i class="bi bi-cart-x fs-1 text-muted"></i>

                <h5 class="mt-3 text-muted">
                    Estado:
                    <span class="badge badge-pendiente">
                        <i class="bi bi-clock me-1"></i>{{ ucfirst($pedido->estado) }}
                    </span>
                </h5>

                <p class="text-muted">
                    Este pedido no tiene productos porque aún está en estado "{{ $pedido->estado }}".
                </p>
            </div>

        @else

            <div class="table-responsive">
                <table class="table panel-table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pedido->detalles as $detalle)
                            <tr>

                                <td>
                                    <img class="imagen-producto"
                                         src="{{ asset('img/catalogo/' . basename($detalle->producto->imagen)) }}"
                                         alt="{{ $detalle->producto->nombre }}">
                                </td>

                                <td class="fw-medium text-dark">
                                    {{ $detalle->producto->nombre }}
                                </td>

                                <td>{{ $detalle->cantidad }}</td>

                                <td>
                                    ${{ number_format($detalle->precio_unitario, 2, ',', '.') }}
                                </td>

                                <td class="fw-bold text-success">
                                    ${{ number_format($detalle->subtotal, 2, ',', '.') }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="panel-footer">

                <div class="text-end mb-4 pb-3 border-bottom">
                    <p class="mb-0 panel-subtitulo">
                        Total: ${{ number_format($pedido->total, 2, ',', '.') }}
                    </p>
                </div>

                <div class="row g-4">

                    <div class="col-md-6">
                        <h6 class="text-uppercase small panel-subtitulo">
                            Método de Pago
                        </h6>

                        @if(strtolower($pedido->estado) == 'carrito')
                            <p class="mb-0 text-secondary">
                                <i class="bi bi-wallet2"></i> A definir
                            </p>
                        @else
                            <p class="mb-0 fw-medium">
                                {{ $pedido->metodoPago->descripcion ?? $pedido->metodoPago->nombre ?? 'No especificado' }}
                            </p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-uppercase small panel-subtitulo">
                            Tipo de Entrega
                        </h6>

                        @if(strtolower($pedido->estado) == 'carrito')
                            <p class="mb-0 text-secondary">
                                <i class="bi bi-box-seam"></i> A definir al finalizar compra
                            </p>
                        @else

                            @if($pedido->envio)
                                <p class="mb-0 text-success fw-medium">
                                    <i class="bi bi-truck"></i> Envío a Domicilio
                                </p>

                                <small class="text-muted d-block mt-1">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $pedido->envio->direccion->provincia }}, {{ $pedido->envio->direccion->localidad }}
                                    | CP: {{ $pedido->envio->direccion->codigo_postal }}<br>
                                    {{ $pedido->envio->direccion->direccion }}
                                </small>

                            @else
                                <p class="mb-0 text-success fw-medium">
                                    <i class="bi bi-shop"></i> Retiro en Sucursal
                                </p>

                                <small class="text-muted d-block mt-1">
                                    Te avisaremos cuando esté listo para retirar.
                                </small>
                            @endif

                        @endif
                    </div>

                </div>
            </div>

        @endif

    </div>
</div>

@endsection