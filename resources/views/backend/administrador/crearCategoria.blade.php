@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Crear Categoría</title>

<div class="container my-5">

    {{-- HEADER --}}
    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Crear categoría</h1>
            <p class="panel-subtitulo">Añade nuevas categorías al sistema</p>
        </div>
    </div>

    {{-- CARD --}}
    <div class="panel-card">

        <div class="panel-form">

            <form action="{{ route('admin.categorias.guardar') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- NOMBRE --}}
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text"
                           name="nombre"
                           class="form-control"
                           placeholder="Nombre de la categoría">
                </div>

                {{-- DESCRIPCIÓN --}}
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion"
                              rows="4"
                              class="form-control"
                              placeholder="Descripción de la categoría"></textarea>
                </div>

                {{-- IMAGEN --}}
                <div class="mb-3">
                    <label class="form-label">Imagen</label>
                    <input type="file"
                           name="imagen"
                           class="form-control">
                </div>

                <div class="form-separador"></div>

                {{-- BOTONES --}}
                <div class="d-flex gap-2 mt-4">

                    <button type="submit" class="btn btn-catalogo flex-fill">
                        <i class="bi bi-save me-2"></i>
                        Guardar categoría
                    </button>

                    <a href="{{ route('admin.categorias') }}" class="btn btn-catalogo flex-fill">
                        <i class="bi bi-x-circle me-2"></i>
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection