@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>crear_categoria</title>

<div class="container py-4">

    <div class="mi-cuenta-card">

        <div class="card-body">

            <h2 class="mi-cuenta-titulo">
                Crear categoría
            </h2>

            <form action="{{ route('admin.categorias.guardar') }}" enctype="multipart/form-data"
                method="POST">

                @csrf

                <div class="mb-4">

                    <label class="form-label">
                        Nombre
                    </label>

                    <input type="text"
                        name="nombre"
                        class="form-control">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                        rows="4"></textarea>

                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Imagen
                    </label>

                    <input type="file"
                        name="imagen"
                        class="form-control">
                </div>

                <button class="btn btn-guardar">

                    Guardar categoría

                </button>

                <a href="{{ route('admin.productos') }}"
                    class="btn btn-guardar">

                    Salir

                </a>

            </form>

        </div>

    </div>

</div>

@endsection