@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Bandeja de consultas</title>

<div class="container my-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- HEADER (igual estilo pedidos) --}}
    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Bandeja de Consultas</h1>
            <p class="panel-subtitulo">Gestión de mensajes y contactos de usuarios.</p>
        </div>

        <div>
            <span class="badge bg-dark-subtle px-3 py-2 rounded-pill fw-semibold panel-subtitulo">
                Total: <span id="total-badge">{{ $consultas->count() }}</span>
            </span>
        </div>
    </div>

    <div class="panel-card">

        {{-- FILTROS (MISMO LAYOUT QUE PEDIDOS) --}}
        <div class="panel-filtros">
            <div class="row align-items-center g-3">

                <div class="col-md-4 col-lg-3">
                    <h5 class="mb-0 fw-semibold panel-subtitulo">
                        Mensajes Recibidos
                    </h5>
                </div>

                <div class="col-md-8 col-lg-9 text-end">

                    <div class="d-inline-flex flex-column flex-sm-row gap-2 w-100 justify-content-end align-items-center"
                         style="max-width: 800px;">

                        {{-- FECHAS --}}
                        <div class="input-group filtro-fechas">
                            <span class="input-group-text">Desde</span>
                            <input type="date" id="fecha-desde" class="form-control">

                            <span class="input-group-text">Hasta</span>
                            <input type="date" id="fecha-hasta" class="form-control">
                        </div>

                        {{-- ESTADO --}}
                        <select id="filtro-estado" class="form-select filtro-control">
                            <option value="todos">Todos</option>
                            <option value="contestado">Contestado</option>
                            <option value="pendiente">Pendiente</option>
                        </select>

                        {{-- BUSCADOR --}}
                        <div class="position-relative w-100" style="max-width: 250px;">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"
                               style="z-index: 5;"></i>
                            <input type="text"
                                   id="buscador"
                                   class="form-control filtro-control ps-5"
                                   placeholder="Buscar...">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="table-scroll table-responsive">

            <table class="table table-hover panel-table align-middle mb-0" id="tabla-consultas">

                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                        <th>Mensaje</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($consultas as $consulta)

                        <tr class="fila-consulta"
                            data-estado="{{ $consulta->contestado ? 'contestado' : 'pendiente' }}"
                            data-fecha="{{ $consulta->created_at->format('Y-m-d') }}">

                            <td class="text-secondary small">
                                {{ $consulta->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="fw-semibold text-dark">
                                {{ $consulta->nombre }}
                            </td>

                            <td>
                                <a href="mailto:{{ $consulta->email }}"
                                style="color: var(--azul); font-weight: 500; text-decoration: none;">
                                    {{ $consulta->email }}
                                </a>
                            </td>

                            <td class="text-secondary fw-medium">
                                {{ Str::limit($consulta->asunto, 25, '...') }}
                            </td>

                            <td>
                                @if($consulta->contestado)
                                    <span class="badge badge-compras">
                                        <i class="bi bi-check2-all me-1"></i> Contestado
                                    </span>
                                @else
                                    <span class="badge badge-pendiente">
                                        <i class="bi bi-clock me-1"></i> Pendiente
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex justify-content-between align-items-center">

                                    <span class="text-truncate" style="max-width: 180px;">
                                        {{ Str::limit($consulta->mensaje, 40, '...') }}
                                    </span>

                                    <a href="{{ route('admin.consultas.show', $consulta->id) }}"
                                    class="btn btn-vermas-pedido btn-sm">
                                        <i class="bi bi-eye me-1"></i> Ver
                                    </a>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr id="fila-vacia-bd">
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No se encontraron consultas registradas.
                            </td>
                        </tr>

                    @endforelse

                    <tr id="sin-resultados" class="d-none">
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-search fs-2 d-block mb-2 texto-rosa"></i>
                            <span class="fw-medium texto-rosa">
                                No hay coincidencias para el término buscado.
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>
</div>

<script>
    const buscador = document.getElementById('buscador');
    const filtroEstado = document.getElementById('filtro-estado');
    const fechaDesde = document.getElementById('fecha-desde');
    const fechaHasta = document.getElementById('fecha-hasta');
    const badgeTotal = document.getElementById('total-badge');
    const filas = document.querySelectorAll('.fila-consulta');
    const sinResultados = document.getElementById('sin-resultados');

    function filtrarConsultas() {
        const termino = buscador.value.toLowerCase().trim();
        const estadoSeleccionado = filtroEstado.value;
        const valorDesde = fechaDesde.value;
        const valorHasta = fechaHasta.value;
        
        let filasVisibles = 0;

        filas.forEach(fila => {
            const nombre = fila.querySelector('.dato-nombre').textContent.toLowerCase();
            const email = fila.querySelector('.dato-email').textContent.toLowerCase();
            const asunto = fila.querySelector('.dato-asunto').textContent.toLowerCase();
            
            // Obtenemos el estado y fecha de la consulta desde los atributos data
            const estadoFila = fila.getAttribute('data-estado');
            const fechaFila = fila.getAttribute('data-fecha');

            // Verificamos coincidencias
            const coincideTexto = nombre.includes(termino) || email.includes(termino) || asunto.includes(termino);
            const coincideEstado = estadoSeleccionado === 'todos' || estadoFila === estadoSeleccionado;
            
            let coincideFecha = true;
            if (valorDesde && fechaFila < valorDesde) {
                coincideFecha = false;
            }
            if (valorHasta && fechaFila > valorHasta) {
                coincideFecha = false;
            }

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

        if (filas.length > 0) {
            if (filasVisibles === 0) {
                sinResultados.classList.remove('d-none');
            } else {
                sinResultados.classList.add('d-none');
            }
        }
    }

    // Agregamos los event listeners
    buscador.addEventListener('input', filtrarConsultas);
    filtroEstado.addEventListener('change', filtrarConsultas);
    fechaDesde.addEventListener('change', filtrarConsultas);
    fechaHasta.addEventListener('change', filtrarConsultas);
</script>

@endsection