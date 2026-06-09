@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Detalle de Consulta</title>

<div class="container my-5">
    <div class="mb-4">
        <a href="{{ route('admin.consultas.index') }}" class="text-decoration-none text-secondary">
            <i class="bi bi-arrow-left"></i> Volver a la bandeja
        </a>
    </div>

<div class="consulta-detalle-card">
    <div class="header-custom border-bottom mb-4 pb-3">
        <h1 class="h3 fw-bold admin-titulo mb-1">
            <i class="bi bi-envelope-open me-2"></i>Detalle de la consulta
        </h1>
    </div>
    
    <form action="{{ route('admin.consultas.responder', $consulta->id) }}" method="POST">
        @csrf
        <div class="body-custom admin-subtitulo">
            <div class="row mb-4 g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block fw-medium">Remitente:</small>
                    <span class="text-dark fw-semibold fs-5">{{ $consulta->nombre }}</span> 
                    <a href="mailto:{{ $consulta->email }}" class="text-muted d-block text-decoration-none">{{ $consulta->email }}</a>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-muted d-block fw-medium">Fecha de recepción:</small>
                    <span class="text-secondary">{{ $consulta->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="mb-4">
                <small class="text-muted d-block mb-2 fw-medium">Asunto:</small>
                <div class="px-4 py-2 bg-white border rounded text-dark fw-semibold shadow-sm">
                    {{ $consulta->asunto }}
                </div>
            </div>

            <div class="mb-4">
                <small class="text-muted d-block mb-2 fw-medium">Mensaje original:</small>
                <div class="p-4 bg-white rounded text-secondary shadow-sm" style="white-space: pre-wrap;">{{ $consulta->mensaje }}</div>
            </div>

            <hr class="my-4">

            <div class="mb-3">
                <label for="respuesta" class="form-label fw-bold text-dark">
                    <i class="bi bi-reply text-primary me-1"></i> Redactar Respuesta:
                </label>
                @if($consulta->contestado)
                    <div class="alert alert-success border-0 shadow-sm">
                        <i class="bi bi-check-circle-fill me-2"></i> Esta consulta ya fue respondida el {{ $consulta->updated_at->format('d/m/Y') }}.
                    </div>
                @else
                    <textarea name="respuesta" id="respuesta" class="form-control" rows="6" placeholder="Escribe aquí tu respuesta para el usuario..." required></textarea>
                @endif
            </div>
        </div>
        
        @if(!$consulta->contestado)
        <div class="footer-custom pt-4 text-end">
            <button type="submit" class="btn px-4 rounded-pill">
                <i class="bi bi-send-fill me-1"></i> Enviar Respuesta
            </button>
        </div>
        @endif
    </form>
</div>
</div>
@endsection