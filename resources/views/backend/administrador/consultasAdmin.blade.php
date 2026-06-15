@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Bandeja de consultas</title>

<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold admin-titulo mb-1">Bandeja de Consultas</h1>
            <p class="admin-subtitulo small mb-0">Gestión de mensajes y contactos de usuarios.</p>
        </div>
        <div>
            <span class="badge bg-dark-subtle px-3 py-2 rounded-pill fw-semibold admin-subtitulo">
                Total: <span id="total-badge">{{ $consultas->count() }}</span>
            </span>
        </div>
    </div>

    <div class="card shadow-sm" style="transform: none !important; transition: none !important; overflow: hidden; border-radius: 12px;">
        
        <div class="card-header bg-white border-bottom py-3 px-4 admin-subtitulo">
            <div class="row align-items-center g-3">
                <div class="col-md-4 col-lg-3">
                    <h5 class="mb-0 fw-semibold text-secondary">Mensajes Recibidos</h5>
                </div>
                <div class="col-md-8 col-lg-9 text-end">
                    <div class="d-inline-flex flex-column flex-sm-row gap-2 w-100 justify-content-end align-items-center" style="max-width: 850px;">
                        
                        <div class="input-group shadow-sm" style="width: auto; height: 38px; flex-wrap: nowrap; border-radius: 50rem;">
                            <span class="input-group-text bg-white text-muted border-end-0" style="border-color: #dee2e6; border-top-left-radius: 50rem !important; border-bottom-left-radius: 50rem !important;">
                                Desde
                            </span>
                            <input type="date" id="fecha-desde" class="form-control border-start-0 text-secondary" style="border-color: #dee2e6;" title="Fecha inicial">
                            
                            <span class="input-group-text bg-white text-muted border-start-0 border-end-0" style="border-color: #dee2e6;">
                                Hasta
                            </span>
                            <input type="date" id="fecha-hasta" class="form-control border-start-0 text-secondary" style="border-color: #dee2e6; border-top-right-radius: 50rem !important; border-bottom-right-radius: 50rem !important;" title="Fecha final">
                        </div>

                        <select id="filtro-estado" class="form-select rounded-pill text-secondary" style="width: auto; height: 38px;">
                            <option value="todos">Todos los estados</option>
                            <option value="contestado">Contestado</option>
                            <option value="pendiente">Pendiente</option>
                        </select>

                        <div class="position-relative w-100">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;"></i>
                            <input type="text" id="buscador" class="form-control rounded-pill ps-5" placeholder="Buscar por nombre, email o asunto..." style="height: 38px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive admin-subtitulo">
            <table class="table table-hover align-middle mb-0" id="tabla-consultas">
                <thead>
                    <tr>
                        <th scope="col" class="px-4 py-3 fw-bold">Fecha</th>
                        <th scope="col" class="px-3 py-3 fw-bold">Nombre</th>
                        <th scope="col" class="px-3 py-3 fw-bold">Email</th>
                        <th scope="col" class="px-3 py-3 fw-bold">Asunto</th>
                        <th scope="col" class="px-3 py-3 fw-bold">Estado</th>
                        <th scope="col" class="px-4 py-3 fw-bold">Mensaje</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($consultas as $consulta)
                        <tr class="fila-consulta" 
                            data-estado="{{ $consulta->contestado ? 'contestado' : 'pendiente' }}"
                            data-fecha="{{ $consulta->created_at->format('Y-m-d') }}">
                            <td class="px-4 py-3 text-secondary small">
                                {{ $consulta->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-3 py-3 fw-semibold text-dark dato-nombre">
                                {{ $consulta->nombre }}
                            </td>
                            <td class="px-3 py-3 dato-email">
                                <a href="mailto:{{ $consulta->email }}" class="text-decoration-none" style="color: var(--azul); font-weight: 500;">
                                    {{ $consulta->email }}
                                </a>
                            </td>
                            <td class="px-3 py-3 text-secondary fw-medium dato-asunto">
                                {{ Str::limit($consulta->asunto, 25, '...') }}
                            </td>
                            <td class="px-3 py-3">
                                @if($consulta->contestado)
                                    <span class="badge" style="background-color: rgba(107, 214, 161, 0.2); color: #2d7a4f; border: 1px solid var(--verde); padding: 5px 12px; border-radius: 20px;">
                                        <i class="bi bi-check2-all me-1"></i> Contestado
                                    </span>
                                @else
                                    <span class="badge" style="background-color: rgba(233, 166, 167, 0.2); color: #a13d3f; border: 1px solid var(--rosa); padding: 5px 12px; border-radius: 20px;">
                                        <i class="bi bi-clock me-1"></i> Pendiente
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-4 py-3 text-secondary small">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-truncate pe-2" style="max-width: 180px;">
                                        {{ Str::limit($consulta->mensaje, 40, '...') }}
                                    </span>

                                    <a href="{{ route('admin.consultas.show', $consulta->id) }}" 
                                       class="btn btn-sm btn-vermas text-decoration-none" 
                                       style="font-size: 0.75rem; height: 24px; width: 65px; flex: none !important;">
                                        <i class="bi bi-eye me-1"></i> Ver
                                    </a>
                                </div> 
                            </td>
                        </tr>
                    @empty
                        <tr id="fila-vacia-bd">
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-black-50"></i>
                                No se encontraron consultas registradas en el sistema.
                            </td>
                        </tr>
                    @endforelse
                    
                    <tr id="sin-resultados" class="d-none">
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-search fs-2 d-block mb-2" style="color: var(--rosa);"></i>
                            <span class="fw-medium" style="color: var(--rosa);">No hay coincidencias para el término buscado.</span>
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