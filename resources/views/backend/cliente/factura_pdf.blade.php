<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pedido #{{ $pedido->numero_pedido }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            border-top: 8px solid #437eaf; /* Tu Azul */
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .header-table td {
            padding-bottom: 20px;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            color: #437eaf; /* Tu Azul */
        }
        .text-right {
            text-align: right;
        }
        /* Nueva clase para la caja del cliente */
        .cliente-box {
            margin-bottom: 25px;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #437eaf; /* Tu Azul */
            border-radius: 4px;
        }
        .info-table {
            margin-bottom: 30px;
        }
        .info-table td {
            padding: 10px;
            background: #fff8d2; /* Tu Amarillo */
            border: 1px solid #e9a6a7; /* Tu Rosa */
            vertical-align: top;
            width: 50%;
            border-radius: 4px;
        }
        .info-heading {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            color: #437eaf; /* Tu Azul */
            margin-bottom: 5px;
        }
        .items-table {
            border: 1px solid #e9a6a7; /* Tu Rosa */
            margin-bottom: 20px;
        }
        .items-table th {
            background: #437eaf; /* Tu Azul */
            color: #ffffff;
            font-weight: bold;
            padding: 10px;
            font-size: 12px;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #e9a6a7; /* Tu Rosa */
        }
        .totals-table {
            width: 40%;
            float: right;
            margin-bottom: 30px;
        }
        .totals-table td {
            padding: 6px 10px;
        }
        .totals-table tr.total td {
            font-weight: bold;
            font-size: 16px;
            color: #437eaf; /* Tu Azul */
            border-top: 2px solid #437eaf;
            padding-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 11px;
            color: #6c757d;
            border-top: 1px solid #e9a6a7; /* Tu Rosa */
            padding-top: 15px;
            clear: both;
        }
        .badge-success {
            color: rgb(107, 214, 161); /* Tu Verde */
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <table class="header-table">
        <tr>
            <td class="title">
            <img src="{{ public_path('img/logo.png') }}" alt="Logo TnToys" style="max-width: 120px; height: auto;">
            </td>
            <td class="text-right">
                <strong>Comprobante de Compra</strong><br>
                Pedido #: {{ $pedido->numero_pedido }}<br>
                Fecha: {{ $pedido->fecha_venta ? $pedido->fecha_venta->format('d/m/Y H:i') : now()->format('d/m/Y') }}<br>
            </td>
        </tr>
    </table>

    <div class="cliente-box">
        <div class="info-heading">Facturado a:</div>
        <strong>{{ $pedido->usuario->nombre ?? 'Consumidor Final' }} {{ $pedido->usuario->apellido ?? '' }}</strong><br>
        DNI: {{ $pedido->usuario->dni ?? 'No especificado' }}<br>
        {{ $pedido->usuario->email ?? '' }}
    </div>

    <table class="info-table">
        <tr>
            <td>
                <div class="info-heading">Método de Pago</div>
                <strong>{{ $pedido->metodoPago->descripcion ?? 'No especificado' }}</strong>
                
                <div class="info-heading" style="margin-top: 15px;">Tipo de Entrega</div>
                @if(!$pedido->envio || $pedido->envio->costo_envio == 0)
                    <strong>Retiro en Sucursal / Sin cargo</strong>
                @else
                    <strong>Envío a Domicilio</strong>
                @endif
            </td>
            <td>
                <div class="info-heading">Detalles de Entrega</div>
                @if($pedido->envio && $pedido->envio->costo_envio > 0)
                    {{ $pedido->envio->direccion->direccion ?? '' }}<br>
                    {{ $pedido->envio->direccion->localidad ?? '' }}, {{ $pedido->envio->direccion->provincia ?? '' }}<br>
                    CP: {{ $pedido->envio->codigo_postal ?? '' }}
                @else
                    <span>Puedes pasar a retirar por nuestro local principal con tu DNI y número de comprobante.</span>
                @endif
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%;">Cant.</th>
                <th>Producto</th>
                <th class="text-right" style="width: 20%;">Precio Unit.</th>
                <th class="text-right" style="width: 20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalles as $item)
                <tr>
                    <td style="text-align: center;">{{ $item->cantidad }}</td>
                    <td>
                        {{ $item->producto->nombre ?? 'Producto #' . $item->producto_id }}
                    </td>
                    <td class="text-right">${{ number_format($item->precio_unitario ?? 0, 2, ',', '.') }}</td>
                    <td class="text-right">
                        ${{ number_format(($item->cantidad * ($item->precio_unitario ?? 0)), 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals-table">
        <tr>
            <td>Subtotal:</td>
            <td class="text-right">${{ number_format($pedido->subtotal, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Costo de Envío:</td>
            <td class="text-right">
                @if($pedido->envio && $pedido->envio->costo_envio > 0)
                    ${{ number_format($pedido->envio->costo_envio, 2, ',', '.') }}
                @else
                    <span class="badge-success">Gratis</span>
                @endif
            </td>
        </tr>
        <tr class="total">
            <td>Total:</td>
            <td class="text-right">${{ number_format($pedido->total, 2, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>¡Muchas gracias por elegirnos y confiar en nosotros!</p>
        <p style="font-size: 9px; color: #adb5bd;">Este documento sirve como constancia de pedido en línea y no es válido como factura legal fiscal.</p>
    </div>
</div>

</body>
</html>