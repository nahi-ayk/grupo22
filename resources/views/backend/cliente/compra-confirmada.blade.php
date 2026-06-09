@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Compra Confirmada</title>
<div class="container my-5" style="max-width: 800px;">
    
    <!--Card de exito principal---->
    <div class="card border-0 shadow-sm text-center p-4 mb-4" style="transform: none !important; transition: none !important; overflow: hidden; border-radius: 12px;">
        <div class="card-body">
            {{-- Ícono animado o de check --}}
            <div class="text-success mb-3" style="font-size: 4rem;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            
            <h2 class="card-title fw-bold admin-titulo">¡Muchas gracias por tu compra!</h2>
            <p class="card-text admin-subtitulo fs-5 text-center">Tu pedido ha sido procesado con éxito.</p>
            
            <hr class="my-4 text-muted opacity-25">

            {{-- TEXTO DINÁMICO SEGÚN EL TIPO DE ENTREGA --}}
            {{-- Puedes capturar si fue envío o retiro mandándolo también por sesión en el confirmar() --}}
            <div class="bg-light p-3 rounded-3 text-start mb-4">
                <h5 class="fw-bold <text-dark>" style="color: var(--rosa); font-family: 'Fjalla One', Arial; ">¿Qué pasa ahora?</h5>
                
                @if($pedido->envio)
                    <p class="text-muted mb-0" style="font-family: 'Fjalla One', Arial;">
                        Hemos registrado tus datos de envío. En las próximas horas prepararemos tu paquete y recibirás un correo electrónico con los datos de seguimiento logístico para tu localidad.
                    </p>
                @else
                    <p class="text-muted mb-0" style="font-family: 'Fjalla One', Arial;">
                        Tu pedido se registrará para <strong>Retiro en Sucursal</strong>. Ya puedes acercarte a nuestro local principal con tu DNI y el número de comprobante para retirar tus productos. ¡Te esperamos!
                    </p>
                @endif


                {{-- CONDICIONAL: DATOS BANCARIOS FICTICIOS SI ES TRANSFERENCIA --}}
                @if(isset($pedido->metodoPago) && str_contains(strtolower($pedido->metodoPago->descripcion), 'transferencia'))
                    <div class="alert alert-info mt-3 mb-0" style="font-family: 'Fjalla One', Arial;">
                        <h6 class="fw-bold mb-2"><i class="bi bi-bank me-2"></i>Datos para la transferencia:</h6>
                        <ul class="mb-0 small list-unstyled">
                            <li><strong>Banco:</strong> Banco de la República</li>
                            <li><strong>Titular:</strong> TnToys E-commerce S.A.</li>
                            <li><strong>CBU / CVU:</strong> 0000003100012345678901</li>
                            <li><strong>Alias:</strong> TNTOYS.PAGOS</li>
                            <li class="mt-2 text-muted"><em>Por favor, envía el comprobante a tntoysjugueteria@gmail.com indicando tu número de pedido (#{{ $pedido->numero_pedido }}).</em></li>
                        </ul>
                    </div>
                @endif
            </div>

            {{-- BOTÓN PARA DESCARGAR FACTURA EN PDF --}}
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-2">
                
                @php
                    // Comprobamos si el método de pago contiene la palabra "tarjeta" (crédito o débito)
                    $descripcionPago = isset($pedido->metodoPago) ? strtolower($pedido->metodoPago->descripcion) : '';
                    $esTarjeta = str_contains($descripcionPago, 'tarjeta');
                @endphp

                {{-- CONDICIONAL: MOSTRAR PDF SOLO SI SE PAGÓ CON TARJETA --}}
                @if($esTarjeta)
                    <a href="{{ route('pedido.factura', $pedido->id) }}" class="btn btn-danger btn-lg px-4 gap-3" style="font-family: 'Fjalla One', Arial;">
                        <i class="bi bi-file-earmark-pdf-fill me-2"></i> Descargar Factura (PDF)
                    </a>
                @endif

                <a href="{{ url('/catalogo') }}" class="btn btn-catalogo btn-lg px-4">
                    Seguir comprando
                </a>
            </div>
        </div>
    </div>

    <!---Resumen de compra---->
<div class="card-footer bg-light p-4 admin-subtitulo">
    <div class="text-end mb-4 pb-3 border-bottom">
        <div class="d-flex justify-content-end mb-1">
            <span class="text-muted me-3">Subtotal de productos:</span>
            <span class="fw-medium">${{ number_format($pedido->subtotal, 2, ',', '.') }}</span>
        </div>
        
        <div class="d-flex justify-content-end mb-2">
            <span class="text-muted me-3">Costo de envío:</span>
            @if($pedido->envio && $pedido->envio->costo_envio > 0)
                <span class="fw-medium">${{ number_format($pedido->envio->costo_envio, 2, ',', '.') }}</span>
            @else
                <span class="fw-medium text-success">Gratis</span>
            @endif
        </div>

        <h5 class="mb-0 mt-3 fw-bold text-dark">
            Total a pagar: ${{ number_format($pedido->total, 2, ',', '.') }}
        </h5>
    </div>
    <div class="row g-4">
        <div class="col-md-6">
            <h6 class="text-secondary fw-bold text-uppercase small">Método de Pago</h6>
            <p class="mb-0 fw-medium">{{ $pedido->metodoPago->descripcion ?? 'No especificado' }}</p>
        </div>
        <div class="col-md-6">
            <h6 class="text-secondary fw-bold text-uppercase small">Tipo de Entrega</h6>
            @if(!$pedido->envio || $pedido->envio->costo_envio == 0)
                <p class="mb-0 fw-medium" style="color: var(--rosa)"><i class="bi bi-shop"></i> Retiro en Sucursal / Sin cargo</p>
            @else
                <p class="mb-0 text-success fw-medium"><i class="bi bi-truck"></i> Envío a Domicilio</p>
                <small class="text-muted d-block mt-1">
                    {{ $pedido->envio->provincia ?? '' }}, {{ $pedido->envio->localidad ?? '' }} | CP: {{ $pedido->envio->codigo_postal ?? '' }}<br>
                    {{ $pedido->envio->direccion ?? '' }}
                </small>
            @endif
        </div>
    </div>
</div>

</div>

@endsection