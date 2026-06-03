@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Compra Confirmada</title>
<div class="container my-5" style="max-width: 800px;">
    
    {{-- CARD DE ÉXITO PRINCIPAL --}}
    <div class="card border-0 shadow-sm text-center p-4 mb-4" style="border-radius: 15px;">
        <div class="card-body">
            {{-- Ícono animado o de check --}}
            <div class="text-success mb-3" style="font-size: 4rem;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            
            <h2 class="card-title fw-bold text-dark">¡Muchas gracias por tu compra!</h2>
            <p class="card-text text-muted fs-5">Tu pedido ha sido procesado con éxito.</p>
            
            <hr class="my-4 text-muted opacity-25">

            {{-- TEXTO DINÁMICO SEGÚN EL TIPO DE ENTREGA --}}
            {{-- Puedes capturar si fue envío o retiro mandándolo también por sesión en el confirmar() --}}
            <div class="bg-light p-3 rounded-3 text-start mb-4">
                <h5 class="fw-bold <text-dark>"><i class="bi bi-info-circle me-2 text-primary"></i>¿Qué pasa ahora?</h5>
                
                @if(session('tipo_entrega') == 'envio')
                    <p class="text-muted mb-0">
                        Hemos registrado tus datos de envío. En las próximas horas prepararemos tu paquete y recibirás un correo electrónico con los datos de seguimiento logístico para tu localidad.
                    </p>
                @else
                    <p class="text-muted mb-0">
                        Tu pedido se registrará para <strong>Retiro en Sucursal</strong>. Ya puedes acercarte a nuestro local principal con tu DNI y el número de comprobante para retirar tus productos. ¡Te esperamos!
                    </p>
                @endif
            </div>

            {{-- BOTÓN PARA DESCARGAR FACTURA EN PDF --}}
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-2">
                {{-- Aquí apuntarías a la ruta que genere el PDF usando librerías como DomPDF --}}
                <a href="#" class="btn btn-danger btn-lg px-4 gap-3">
                    <i class="bi bi-file-earmark-pdf-fill me-2"></i> Descargar Factura (PDF)
                </a>
                <a href="{{ url('/catalogo') }}" class="btn btn-outline-secondary btn-lg px-4">
                    Seguir comprando
                </a>
            </div>
        </div>
    </div>

    {{-- RESUMEN DE COMPRA ABAJO (OPCIONAL PERO RECOMENDADO) --}}
    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <h4 class="fw-bold mb-3 text-dark">Resumen del Pedido</h4>
        
        <div class="table-responsive">
            <table class="table table-borderless table-sm align-middle">
                <thead>
                    <tr class="text-muted border-bottom">
                        <th>Producto</th>
                        <th class="text-center">Cant.</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                @if(session('items'))
                    @foreach(session('items') as $item)
                <tr>
                {{-- Acceso usando sintaxis de array [] --}}
                <td>{{ $item['producto']['nombre'] }}</td>
                <td class="text-center text-muted">{{ $item['cantidad'] }}</td>
                <td class="text-end fw-semibold">${{ number_format($item['subtotal'], 2) }}</td>
                </tr>
    @endforeach
@endif
                    
                    <tr class="border-top fs-5 fw-bold">
                        <td colspan="2" class="pt-3 text-dark">Total Abonado:</td>
                        <td class="text-end pt-3 text-success">${{ number_format(session('total'), 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection