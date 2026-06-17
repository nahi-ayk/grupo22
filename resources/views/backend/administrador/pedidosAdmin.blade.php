@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Pedidos</title>

<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Listado de Pedidos</h1>
            <p class="panel-subtitulo">Gestión y seguimiento de ventas realizadas.</p>
        </div>
        <div>
            <span class="badge bg-dark-subtle px-3 py-2 rounded-pill fw-semibold panel-subtitulo">
                Total: <span id="total-badge">{{ $pedidos->count() }}</span>
            </span>
        </div>
    </div>

    <div class="panel-card">
        
        <div class="panel-filtros">
            <div class="row align-items-center g-3">
                <div class="col-md-4 col-lg-3">
                    <h5 class="mb-0 fw-semibold panel-subtitulo">Pedidos Recientes</h5>
                </div>
                <div class="col-md-8 col-lg-9 text-end">
                    <div class="d-inline-flex flex-column flex-sm-row gap-2 w-100 justify-content-end align-items-center" style="max-width: 800px;">
                        
                        <div class="input-group filtro-fechas">
                            <span class="input-group-text">
                                Desde
                            </span>
                            <input type="date" id="fecha-desde" class="form-control" title="fecha-inicial">
                            
                            <span class="input-group-text">
                                Hasta
                            </span>
                            <input type="date" id="fecha-hasta" class="form-control" titlt="fecha-final">
                        </div>

                        <select id="filtro-estado" class="form-select filtro-control">
                            <option value="todos">Todos los estados</option>
                            <option value="confirmado">Confirmados</option>
                            <option value="pendiente_pago">Pendientes de pago</option>
                            <option value="carrito">En Carrito</option>
                        </select>

                        <div class="position-relative w-100" style="max-width: 250px;">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;"></i>
                            <input type="text" id="buscador-pedidos" class="form-control filtro-control ps-5" placeholder="Buscar...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-scroll table-responsive">
            <table class="table table-hover panel-table align-middle mb-0" id="tabla-pedidos">
                <thead>
                    <tr>
                        <th>N° Pedido</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($pedidos as $pedido)
                        <tr class="fila-pedido" 
                            data-estado="{{ strtolower($pedido->estado) }}" 
                            data-fecha="{{ \Carbon\Carbon::parse($pedido->fecha_venta ?? $pedido->created_at)->format('Y-m-d') }}">
                            <td class="px-4 py-3 fw-semibold text-dark dato-numero">
                                #{{ $pedido->numero_pedido }}
                            </td>
                            <td class="px-3 py-3 text-secondary small">
                                {{ \Carbon\Carbon::parse($pedido->fecha_venta ?? $pedido->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-3 py-3 dato-cliente">
                                <span class="text-decoration-none" style="color: var(--azul); font-weight: 500;">
                                    {{ $pedido->usuario ? $pedido->usuario->nombre . ' ' . $pedido->usuario->apellido : 'Usuario Desconocido' }}
                                </span>
                            </td>
                            <td class="px-3 py-3 fw-bold text-success">
                                ${{ number_format($pedido->total, 2, ',', '.') }}
                            </td>
                            <td class="px-3 py-3">
                                @if(strtolower($pedido->estado) == 'confirmado')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i> {{ ucfirst($pedido->estado) }}
                                    </span>
                                @elseif(strtolower($pedido->estado) == 'pendiente_pago')
                                    <span class="badge badge-pendiente rounded-pill">
                                        <i class="bi bi-clock me-1"></i> Pendiente de pago
                                    </span>
                                @elseif(strtolower($pedido->estado) == 'carrito')
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1 rounded-pill">
                                        <i class="bi bi-cart me-1"></i> Carrito
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1 rounded-pill">
                                        {{ ucfirst($pedido->estado) }}
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-4 py-3 text-secondary small">
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-vermas-pedido">
                                        <i class="bi bi-eye me-1"></i>Ver
                                    </a>

                                    @if(strtolower($pedido->estado) == 'pendiente_pago')
                                        <form action="{{ route('pedidos.confirmar', $pedido->id) }}" method="POST" class="m-0 p-0">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-verde-compra btn-confirmar-pedido" title="Confirmar Pago">
                                                <i class="bi bi-check2-all me-1"></i> Confirmar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="fila-vacia-bd">
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-bag-x fs-2 d-block mb-2 text-black-50"></i>
                                No se encontraron pedidos registrados en el sistema.
                            </td>
                        </tr>
                    @endforelse
                    
                    <tr id="sin-resultados" class="d-none">
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-search fs-2 d-block mb-2 texto-rosa"></i>
                            <span class="fw-medium texto-rosa">No hay coincidencias para el término buscado.</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      
    </div>
</div>

<script>
    const buscador = document.getElementById('buscador-pedidos');
    const filtroEstado = document.getElementById('filtro-estado');
    const fechaDesde = document.getElementById('fecha-desde');
    const fechaHasta = document.getElementById('fecha-hasta');
    const badgeTotal = document.getElementById('total-badge');
    const filas = document.querySelectorAll('.fila-pedido');
    const sinResultados = document.getElementById('sin-resultados');

    function filtrarPedidos() {
        const termino = buscador.value.toLowerCase().trim();
        const estadoSeleccionado = filtroEstado.value;
        const valorDesde = fechaDesde.value; // Formato nativo: "YYYY-MM-DD"
        const valorHasta = fechaHasta.value; // Formato nativo: "YYYY-MM-DD"
        
        let filasVisibles = 0;

        filas.forEach(fila => {
            const numero = fila.querySelector('.dato-numero').textContent.toLowerCase();
            const cliente = fila.querySelector('.dato-cliente').textContent.toLowerCase();
            
            // Estado
            let estadoFila = fila.getAttribute('data-estado');
            if (estadoFila === 'pagado') estadoFila = 'confirmado';
            
            // Fecha de la fila
            const fechaFila = fila.getAttribute('data-fecha');

            // Lógica de coincidencias
            const coincideTexto = numero.includes(termino) || cliente.includes(termino);
            const coincideEstado = estadoSeleccionado === 'todos' || estadoFila === estadoSeleccionado;
            
            let coincideFecha = true;
            if (valorDesde && fechaFila < valorDesde) {
                coincideFecha = false;
            }
            if (valorHasta && fechaFila > valorHasta) {
                coincideFecha = false;
            }

            // Aplicar visibilidad
            if (coincideTexto && coincideEstado && coincideFecha) {
                fila.classList.remove('d-none');
                filasVisibles++;
            } else {
                fila.classList.add('d-none');
            }
        });

        // Actualizar el número del badge Total dinámicamente
        if (badgeTotal) {
            badgeTotal.textContent = filasVisibles;
        }

        // Manejar el mensaje de "sin resultados"
        if (filas.length > 0) {
            if (filasVisibles === 0) {
                sinResultados.classList.remove('d-none');
            } else {
                sinResultados.classList.add('d-none');
            }
        }
    }

    // Escuchar eventos en todos los filtros
    buscador.addEventListener('input', filtrarPedidos);
    filtroEstado.addEventListener('change', filtrarPedidos);
    fechaDesde.addEventListener('change', filtrarPedidos);
    fechaHasta.addEventListener('change', filtrarPedidos);
</script>

@endsection