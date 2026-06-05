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
            <span class="badge bg-dark-subtle text-dark px-3 py-2 rounded-pill fw-semibold">
                Total: <span id="total-badge">{{ $consultas->count() }}</span>
            </span>
        </div>
    </div>

    <div class="card shadow-sm" style="transform: none !important; transition: none !important;">
        
<div class="card-header bg-white border-bottom py-3 px-4">
    <div class="row align-items-center g-3">
        <div class="col-md-4 col-lg-3">
            <h5 class="mb-0 fw-semibold text-secondary">Mensajes Recibidos</h5>
        </div>
        <div class="col-md-8 col-lg-9 text-end">
            <div class="d-inline-block w-100" style="max-width: 400px;">
                <div class="position-relative w-100">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="z-index: 5;"></i>
                    <input type="text" id="buscador" class="form-control rounded-pill ps-5" placeholder="Buscar por nombre o email..." style="height: 38px;">
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tabla-consultas">
                <thead class="table-light text-uppercase fs-7 tracking-wider">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-muted fw-semibold" style="width: 15%;">Fecha</th>
                        <th scope="col" class="px-3 py-3 text-muted fw-semibold" style="width: 22%;">Nombre</th>
                        <th scope="col" class="px-3 py-3 text-muted fw-semibold" style="width: 25%;">Email</th>
                        <th scope="col" class="px-3 py-3 text-muted fw-semibold" style="width: 13%;">Estado</th>
                        <th scope="col" class="px-4 py-3 text-muted fw-semibold" style="width: 25%;">Mensaje</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($consultas as $consulta)
                        <tr class="fila-consulta">
                            <td class="px-4 py-3 text-secondary small">
                                {{ $consulta->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-3 py-3 fw-semibold text-dark dato-nombre">
                                {{ $consulta->nombre }}
                            </td>
                            <td class="px-3 py-3 dato-email">
                                <a href="mailto:{{ $consulta->email }}" class="text-primary text-decoration-none fw-medium">
                                    {{ $consulta->email }}
                                </a>
                            </td>
                            <td class="px-3 py-3">
                                @if($consulta->contestado)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill">
                                        <i class="bi bi-check2-all me-1"></i> Contestado
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 rounded-pill">
                                        <i class="bi bi-clock me-1"></i> Pendiente
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-secondary small">
                                <div class="d-flex align-items-center justify-content-between w-100">
                                <span class="text-truncate pe-2" style="max-width: 180px;">
                                {{ Str::limit($consulta->mensaje, 40, '...') }}
                                </span>
        
                                <button type="button" 
                                class="btn btn-sm btn-outline-primary flex-shrink-0 py-0 px-2 rounded-pill" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalMensaje{{ $consulta->id }}"
                                style="font-size: 0.75rem; height: 24px; min-width: 55px;">
                                <i class="bi bi-eye"></i> Ver
                                </button>
                                </div> 
                                </td>
                        </tr>
                    @empty
                        <tr id="fila-vacia-bd">
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-black-50"></i>
                                No se encontraron consultas registradas en el sistema.
                            </td>
                        </tr>
                    @endforelse
                    
                    <tr id="sin-resultados" class="d-none">
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-search fs-2 d-block mb-2 text-danger"></i>
                            <span class="fw-medium text-danger">No hay coincidencias para el término buscado.</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($consultas as $consulta)
    <div class="modal fade" id="modalMensaje{{ $consulta->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $consulta->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-header bg-light" style="border-radius: 12px 12px 0 0;">
                    <h5 class="modal-title fw-bold text-dark" id="modalLabel{{ $consulta->id }}">
                        <i class="bi bi-envelope-open text-primary me-2"></i>Consulta de {{ $consulta->nombre }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                
                <form action="{{ route('admin.consultas.responder', $consulta->id) }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row mb-3 g-2">
                            <div class="col-sm-6">
                                <small class="text-muted d-block mb-1 fw-medium">Remitente:</small>
                                <span class="text-dark fw-semibold">{{ $consulta->nombre }}</span> 
                                <span class="text-secondary small d-block d-sm-inline ms-sm-2">({{ $consulta->email }})</span>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <small class="text-muted d-block mb-1 fw-medium">Fecha de envío:</small>
                                <span class="text-secondary small">{{ $consulta->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-2 fw-medium">Mensaje original:</small>
                            <div class="p-3 bg-light rounded text-secondary" style="white-space: pre-wrap; font-size: 0.9rem; max-height: 180px; overflow-y: auto;">{{ $consulta->mensaje }}</div>
                        </div>

                        <hr class="text-muted opacity-25 my-4">

                        <div class="mb-2">
                            <label for="respuesta{{ $consulta->id }}" class="form-label fw-semibold text-dark">
                                <i class="bi bi-reply text-primary me-1"></i> Redactar Respuesta:
                            </label>
                            @if($consulta->contestado)
                                <div class="alert alert-secondary border-0 small py-2 mb-0">
                                    <i class="bi bi-info-circle me-1"></i> Esta consulta ya fue respondida anteriormente.
                                </div>
                            @else
                                <textarea name="respuesta" id="respuesta{{ $consulta->id }}" class="form-control" rows="4" placeholder="Escribe aquí el correo electrónico de respuesta para el usuario..." required></textarea>
                            @endif
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary btn-sm px-3 rounded-pill" data-bs-dismiss="modal">Cerrar</button>
                        @if(!$consulta->contestado)
                            <button type="submit" class="btn btn-primary btn-sm px-4 rounded-pill">
                                <i class="bi bi-send-fill me-1"></i> Enviar Respuesta
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
    document.getElementById('buscador').addEventListener('input', function() {
        const termino = this.value.toLowerCase().trim();
        const filas = document.querySelectorAll('.fila-consulta');
        const sinResultados = document.getElementById('sin-resultados');
        let filasVisibles = 0;

        filas.forEach(fila => {
            const nombre = fila.querySelector('.dato-nombre').textContent.toLowerCase();
            const email = fila.querySelector('.dato-email').textContent.toLowerCase();

            if (nombre.includes(termino) || email.includes(termino)) {
                fila.classList.remove('d-none');
                filasVisibles++;
            } else {
                fila.classList.add('d-none');
            }
        });

        if (filas.length > 0) {
            if (filasVisibles === 0) {
                sinResultados.classList.remove('d-none');
            } else {
                sinResultados.classList.add('d-none');
            }
        }
    });
</script>

@endsection