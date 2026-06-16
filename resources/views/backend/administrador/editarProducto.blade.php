@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Editar Producto</title>

<div class="container my-5">

    {{-- HEADER --}}
    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Editar Producto</h1>
            <p class="panel-subtitulo">Modifica la información del producto</p>
        </div>
    </div>

    {{-- CARD --}}
    <div class="panel-card">

        <div class="panel-form">

            <form action="{{ route('producto.actualizar', $producto->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- FILA 1 --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text"
                               name="nombre"
                               class="form-control"
                               value="{{ old('nombre', $producto->nombre) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number"
                               step="0.01"
                               name="precio_venta"
                               class="form-control"
                               value="{{ old('precio_venta', $producto->precio_venta) }}">
                    </div>

                </div>

                {{-- DESCRIPCIÓN --}}
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control"
                              name="descripcion"
                              rows="4">{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>

                <div class="form-separador"></div>

                {{-- STOCK + CATEGORÍA --}}
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number"
                               name="stock_actual"
                               class="form-control"
                               value="{{ old('stock_actual', $producto->stock_actual) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stock mínimo</label>
                        <input type="number"
                               name="stock_minimo"
                               class="form-control"
                               value="{{ old('stock_minimo', $producto->stock_minimo) }}">
                    </div>

                    {{-- CATEGORÍA (custom select intacto) --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Categoría</label>

                        <div class="custom-select-container">

                            <input type="hidden"
                                   name="categoria_id"
                                   id="categoria_seleccionada"
                                   value="{{ $producto->categoria_id }}">

                            <div class="select-trigger" id="select_trigger_text">
                                {{ $producto->categoria->nombre ?? 'Seleccionar categoría' }}
                            </div>

                            <ul class="custom-options">

                                @foreach($categorias as $categoria)
                                    <li data-value="{{ $categoria->id }}"
                                        class="{{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}">
                                        {{ $categoria->nombre }}
                                    </li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

                {{-- IMAGEN --}}
                <div class="mb-3">

                    <label class="form-label">Imagen actual</label>

                    <div class="text-center mb-3">
                        <img src="{{ $producto->imagen ? asset($producto->imagen) : asset('img/logo.png') }}"
                             alt="{{ $producto->nombre }}"
                             style="width:150px;height:150px;object-fit:cover;border-radius:15px;border:2px solid #eee;">
                    </div>

                    <label class="form-label">Cambiar imagen</label>
                    <input type="file" name="imagen" class="form-control">

                </div>

                <div class="form-separador"></div>

                {{-- BOTONES --}}
                <div class="d-flex gap-2 mt-4">

                    <button type="submit" class="btn btn-catalogo flex-fill">
                        <i class="bi bi-check-circle me-2"></i>
                        Guardar cambios
                    </button>

                    <a href="{{ route('admin.productos') }}" class="btn btn-catalogo flex-fill">
                        <i class="bi bi-box-arrow-left me-2"></i>
                        Salir
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const trigger = document.getElementById('select_trigger_text');
    const container = document.querySelector('.custom-select-container');
    const hiddenInput = document.getElementById('categoria_seleccionada');
    const options = document.querySelectorAll('.custom-options li');

    trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        container.classList.toggle('active');
    });

    options.forEach(option => {
        option.addEventListener('click', function(e) {
            e.stopPropagation();

            hiddenInput.value = this.getAttribute('data-value');
            trigger.textContent = this.textContent.trim();

            container.classList.remove('active');

            options.forEach(li => li.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    document.addEventListener('click', () => {
        container.classList.remove('active');
    });

});
</script>

@endsection