@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Detalle de Consulta</title>

<div class="container my-5">

    {{-- HEADER --}}
    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">
                <i class="bi bi-envelope-open me-2"></i>
                Detalle de la consulta
            </h1>
            <p class="panel-subtitulo">Gestión de mensajes de usuarios</p>
        </div>
    </div>

    {{-- CARD --}}
    <div class="panel-card">

        <div class="panel-form">

            <div class="mb-3">
                <a href="{{ route('admin.consultas.index') }}"
                   class="text-decoration-none text-secondary">
                    <i class="bi bi-arrow-left"></i> Volver a la bandeja
                </a>
            </div>

            <form action="{{ route('admin.consultas.responder', $consulta->id) }}"
                  method="POST">

                @csrf

                {{-- INFO USUARIO --}}
                <div class="row mb-3">

                    <div class="col-md-6">
                        <label class="form-label">Remitente</label>
                        <div class="fw-semibold panel-subtitulo">{{ $consulta->nombre }}</div>
                        <a href="mailto:{{ $consulta->email }}"
                           class="text-muted text-decoration-none">
                            {{ $consulta->email }}
                        </a>
                    </div>

                    <div class="col-md-6 text-md-end">
                        <label class="form-label">Fecha de recepción</label>
                        <div class="text-secondary">
                            {{ $consulta->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                </div>

                {{-- ASUNTO --}}
                <div class="mb-3">
                    <label class="form-label">Asunto</label>
                    <div class="p-2 border rounded bg-light text-muted text-decoration-none">
                        {{ $consulta->asunto }}
                    </div>
                </div>

                {{-- MENSAJE --}}
                <div class="mb-3">
                    <label class="form-label">Mensaje</label>
                    <div class="p-3 border rounded bg-light text-muted text-decoration-none"
                         style="white-space: pre-wrap;">
                        {{ $consulta->mensaje }}
                    </div>
                </div>

                <div class="form-separador"></div>

                {{-- RESPUESTA --}}
                <div class="mb-3">

                    <label class="form-label">
                        <i class="bi bi-reply me-1"></i> Respuesta
                    </label>

                    @if($consulta->contestado)

                        <div class="alert alert-success border-0">
                            <i class="bi bi-check-circle me-1"></i>
                            Esta consulta ya fue respondida el
                            {{ $consulta->updated_at->format('d/m/Y') }}.
                        </div>

                    @else

                        <textarea name="respuesta"
                                  class="form-control"
                                  rows="6"
                                  placeholder="Escribe tu respuesta..."
                                  required></textarea>

                    @endif

                </div>

                {{-- BOTONES --}}
                @if(!$consulta->contestado)

                    <div class="d-flex gap-2 mt-4">

                        <button type="submit" class="btn btn-catalogo flex-fill">
                            <i class="bi bi-send-fill me-2"></i>
                            Enviar respuesta
                        </button>

                        <a href="{{ route('admin.consultas.index') }}"
                           class="btn btn-catalogo flex-fill">
                            <i class="bi bi-x-circle me-2"></i>
                            Cancelar
                        </a>

                    </div>

                @endif

            </form>

        </div>

    </div>

</div>

@endsection