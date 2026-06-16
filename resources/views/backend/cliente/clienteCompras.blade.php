@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Mis Compras</title>

<div class="container-fluid px-2 my-4">
    <div class="panel-header">

        <div>
            <h1 class="panel-titulo">Mis Compras</h1>
            <p class="panel-subtitulo">
                Historial de tus pedidos realizados.
            </p>
        </div>

        <span class="panel-subtitulo">
            Total: {{ $pedidos->count() }}
        </span>

    </div>

    <div class="panel-card">
        <div class="table-scroll table-responsive">
            <table class="table table-hover panel-table">
                <thead class="table-light">
                    <tr>
                        <th>N° Pedido</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pedidos as $pedido)
                        <tr>
                            <td class="fw-bold">#{{ $pedido->numero_pedido }}</td>
                            <td class="text-secondary">
                                {{ \Carbon\Carbon::parse($pedido->fecha_venta ?? $pedido->created_at)->format('d/m/Y') }}
                            </td>
                            <td class="fw-bold text-success">${{ number_format($pedido->total, 2, ',', '.') }}</td>
                            <td>
                                @if(in_array(strtolower($pedido->estado), ['confirmado', 'pagado']))
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i>    {{ ucfirst($pedido->estado) }}
                                    </span>
                                @else
                                    <span class="badge badge-pendiente rounded-pill"> 
                                    <i class="bi bi-clock me-1"></i>    {{ ucfirst($pedido->estado) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('cliente.compras.detalle', $pedido->id) }}" class="btn btn-vermas-pedido">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Aún no has realizado ninguna compra.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection