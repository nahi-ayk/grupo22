@extends('backend.plantillaBackend')
@section('titulo', 'Detalle Pedido #' . $pedido->numero_pedido)
@section('contenidoBackend')

<div class="container my-5">
    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">
                Detalle de mi Pedido #{{ $pedido->numero_pedido }}
            </h1>
            <p class="panel-subtitulo">
                Realizado el:
                {{ $pedido->created_at ? $pedido->created_at->format('d/m/Y H:i') : 'N/A' }}
            </p>
        </div>

        <a href="{{ route('cliente.compras') }}" class="btn btn-catalogo">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>
    </div>

    <div class="panel-card">
        <div class="panel-form">
            <h5 class="mb-4 text-secondary">
                Productos en el Pedido
            </h5>

            @if($pedido->detalles->isEmpty())

                <div class="text-center py-5">
                    <i class="bi bi-cart-x fs-1 text-muted"></i>
                    <h5 class="mt-3 text-muted">
                        Estado:
                        <span class="badge badge-pendiente">
                            <i class="bi bi-clock me-1"></i>
                            {{ ucfirst($pedido->estado) }}
                        </span>
                    </h5>
                    <p class="text-muted">
                        Este pedido no tiene productos porque aún está en estado "{{ $pedido->estado }}".
                    </p>
                </div>

            @else

                <div class="table-responsive">
                    <table class="table table-hover panel-table">
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
                                        <img
                                            src="{{ asset('img/catalogo/' . basename($detalle->producto->imagen)) }}"
                                            alt="{{ $detalle->producto->nombre }}"
                                            class="imagen-producto"
                                        >
                                    </td>

                                    <td class="fw-medium">
                                        {{ $detalle->producto->nombre }}
                                    </td>

                                    <td>
                                        {{ $detalle->cantidad }}
                                    </td>

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
                        <h5 class="mb-0">
                            Total:
                            ${{ number_format($pedido->total, 2, ',', '.') }}
                        </h5>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="text-secondary fw-bold text-uppercase small">
                                Método de Pago
                            </h6>

                            @if(strtolower($pedido->estado) == 'carrito')

                                <p class="mb-0 text-secondary fw-medium">
                                    <i class="bi bi-wallet2"></i>
                                    A definir al finalizar compra
                                </p>

                            @else

                                <p class="mb-0 fw-medium">
                                    {{ $pedido->metodoPago->descripcion ?? 'No especificado' }}
                                </p>

                            @endif
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-secondary fw-bold text-uppercase small">
                                Tipo de Entrega
                            </h6>
                            @if(strtolower($pedido->estado) == 'carrito')

                                <p class="mb-0 text-secondary fw-medium">
                                    <i class="bi bi-box-seam"></i>
                                    A definir al finalizar compra
                                </p>

                            @else

                                @if($pedido->envio)

                                    <p class="mb-0 text-success fw-medium">
                                        <i class="bi bi-truck"></i>
                                        Envío a Domicilio
                                    </p>

                                    <small class="text-muted d-block mt-1">
                                        <i class="bi bi-geo-alt"></i>

                                        {{ $pedido->envio->direccion->provincia }},
                                        {{ $pedido->envio->direccion->localidad }}

                                        |

                                        CP:
                                        {{ $pedido->envio->direccion->codigo_postal }}

                                        <br>

                                        {{ $pedido->envio->direccion->direccion }}
                                    </small>

                                @else

                                    <p class="mb-0 text-success fw-medium">
                                        <i class="bi bi-shop"></i>
                                        Retiro en Sucursal
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
</div>

@endsection