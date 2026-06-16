@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Compra Confirmada</title>

<div class="container compra-confirmada-container my-5">

    <!-- Card principal -->
    <div class="panel-card text-center mb-4">

        <div class="panel-form">

            <div class="icono-exito mb-3">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <h1 class="panel-titulo">
                ¡Muchas gracias por tu compra!
            </h1>

            <p class="panel-subtitulo">
                Tu pedido ha sido procesado con éxito.
            </p>

            <hr class="my-4">

            <div class="panel-info">

                <h5 class="panel-info-titulo">
                    ¿Qué pasa ahora?
                </h5>

                @if($pedido->envio)

                    <p class="text-muted mb-0">
                        Hemos registrado tus datos de envío. En las próximas horas prepararemos tu paquete y recibirás un correo electrónico con los datos de seguimiento logístico para tu localidad.
                    </p>

                @else

                    <p class="text-muted mb-0">
                        Tu pedido se registrará para <strong>Retiro en Sucursal</strong>. Ya puedes acercarte a nuestro local principal con tu DNI y el número de comprobante para retirar tus productos. ¡Te esperamos!
                    </p>

                @endif

                @if(isset($pedido->metodoPago) && str_contains(strtolower($pedido->metodoPago->descripcion), 'transferencia'))

                    <div class="alert alert-info mt-3 mb-0 panel-alerta">

                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-bank me-2"></i>
                            Datos para la transferencia:
                        </h6>

                        <ul class="mb-0 small list-unstyled">

                            <li>
                                <strong>Banco:</strong>
                                Banco de la República
                            </li>

                            <li>
                                <strong>Titular:</strong>
                                TnToys E-commerce S.A.
                            </li>

                            <li>
                                <strong>CBU / CVU:</strong>
                                0000003100012345678901
                            </li>

                            <li>
                                <strong>Alias:</strong>
                                TNTOYS.PAGOS
                            </li>

                            <li class="mt-2 text-muted">
                                <em>
                                    Por favor, envía el comprobante a
                                    tntoysjugueteria@gmail.com
                                    indicando tu número de pedido
                                    (#{{ $pedido->numero_pedido }}).
                                </em>
                            </li>

                        </ul>

                    </div>

                @endif

            </div>

            @php
                $descripcionPago = isset($pedido->metodoPago)
                    ? strtolower($pedido->metodoPago->descripcion)
                    : '';

                $esTarjeta = str_contains($descripcionPago, 'tarjeta');
            @endphp

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-3">

                @if($esTarjeta)

                    <a href="{{ route('pedido.factura', $pedido->id) }}"
                       class="btn btn-danger">

                        <i class="bi bi-file-earmark-pdf-fill me-2"></i>
                        Descargar Factura (PDF)

                    </a>

                @endif

                <a href="{{ url('/catalogo') }}" class="btn btn-catalogo">
                    Seguir comprando
                </a>

            </div>

        </div>

    </div>

    <!-- Resumen -->
    <div class="panel-card">

        <div class="panel-footer">

            <div class="text-end mb-4 pb-3 border-bottom">

                <div class="d-flex justify-content-end mb-1">

                    <span class="text-muted me-3">
                        Subtotal de productos:
                    </span>

                    <span class="fw-medium">
                        ${{ number_format($pedido->subtotal, 2, ',', '.') }}
                    </span>

                </div>

                <div class="d-flex justify-content-end mb-2">

                    <span class="text-muted me-3">
                        Costo de envío:
                    </span>

                    @if($pedido->envio && $pedido->envio->costo_envio > 0)

                        <span class="fw-medium">
                            ${{ number_format($pedido->envio->costo_envio, 2, ',', '.') }}
                        </span>

                    @else

                        <span class="fw-medium text-success">
                            Gratis
                        </span>

                    @endif

                </div>

                <h5 class="mb-0 mt-3 fw-bold">

                    Total a pagar:
                    ${{ number_format($pedido->total, 2, ',', '.') }}

                </h5>

            </div>

            <div class="row g-4">

                <div class="col-md-6">

                    <h6 class="text-secondary fw-bold text-uppercase small">
                        Método de Pago
                    </h6>

                    <p class="mb-0 fw-medium">
                        {{ $pedido->metodoPago->descripcion ?? 'No especificado' }}
                    </p>

                </div>

                <div class="col-md-6">

                    <h6 class="text-secondary fw-bold text-uppercase small">
                        Tipo de Entrega
                    </h6>

                    @if(!$pedido->envio || $pedido->envio->costo_envio == 0)

                        <p class="mb-0 fw-medium texto-rosa">
                            <i class="bi bi-shop"></i>
                            Retiro en Sucursal / Sin cargo
                        </p>

                    @else

                        <p class="mb-0 text-success fw-medium">
                            <i class="bi bi-truck"></i>
                            Envío a Domicilio
                        </p>

                        <small class="text-muted d-block mt-1">

                            {{ $pedido->envio->direccion->provincia ?? '' }},
                            {{ $pedido->envio->direccion->localidad ?? '' }}

                            |

                            CP:
                            {{ $pedido->envio->direccion->codigo_postal ?? '' }}

                            <br>

                            {{ $pedido->envio->direccion->direccion ?? '' }}

                        </small>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection