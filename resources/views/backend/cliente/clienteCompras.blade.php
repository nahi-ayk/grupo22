@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Mis Compras</title>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold admin-titulo mb-1">Mis Compras</h1>
            <p class="admin-subtitulo small mb-0">Historial de tus pedidos realizados.</p>
        </div>
        <div>
            <span class="badge px-3 py-2 rounded-pill admin-subtitulo">Total: {{ $pedidos->count() }}</span>
        </div>
    </div>

    <div class="card shadow-sm" style="transform: none !important; transition: none !important; overflow: hidden; border-radius: 12px; font-family: 'Fjalla One', Arial;" >
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">N° Pedido</th>
                        <th class="px-3 py-3">Fecha</th>
                        <th class="px-3 py-3">Total</th>
                        <th class="px-3 py-3">Estado</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pedidos as $pedido)
                        <tr>
                            <td class="px-4 py-3 fw-bold">#{{ $pedido->numero_pedido }}</td>
                            <td class="px-3 py-3 text-secondary">
                                {{ \Carbon\Carbon::parse($pedido->fecha_venta ?? $pedido->created_at)->format('d/m/Y') }}
                            </td>
                            <td class="px-3 py-3 fw-bold text-success">${{ number_format($pedido->total, 2, ',', '.') }}</td>
                            <td class="px-3 py-3">
                                @if(in_array(strtolower($pedido->estado), ['confirmado', 'pagado']))
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i>    {{ ucfirst($pedido->estado) }}
                                    </span>
                                @else
                                    <span class="badge text-secondary border rounded-pill" style="background-color: #fff3cd !important; color: #664d03 !important; border: 1px solid #ffe69c !important;">
                                    <i class="bi bi-clock me-1"></i>    {{ ucfirst($pedido->estado) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('cliente.compras.detalle', $pedido->id) }}" class="btn btn-vermas" style="font-size: 0.75rem; height: 24px; width: 65px; flex: none !important;">
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