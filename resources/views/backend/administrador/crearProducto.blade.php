@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Crear Producto</title>

<div class="container my-5">

    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Añadir Producto</h1>
            <p class="panel-subtitulo">Carga de nuevos productos al catálogo</p>
        </div>
    </div>

    <div class="panel-card">

        <div class="panel-form">

            <form action="{{ route('admin.productos.guardar') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- FILA 1 --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text"
                               name="nombre"
                               class="form-control"
                               placeholder="Nombre del producto">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number"
                               name="precio_venta"
                               class="form-control"
                               placeholder="$0">
                    </div>

                </div>

                {{-- DESCRIPCIÓN --}}
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion"
                              rows="4"
                              class="form-control"
                              placeholder="Descripción del producto"></textarea>
                </div>

                <div class="form-separador"></div>

                {{-- STOCK + CATEGORÍA --}}
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number"
                               name="stock_actual"
                               class="form-control"
                               placeholder="0">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stock mínimo</label>
                        <input type="number"
                               name="stock_minimo"
                               class="form-control"
                               placeholder="0">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Categoría</label>

                        <select name="categoria_id" class="form-control">
                            <option value="">Seleccionar categoría</option>

                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                </div>

                {{-- IMAGEN --}}
                <div class="mb-3">
                    <label class="form-label">Imagen del producto</label>
                    <input type="file" name="imagen" class="form-control">
                </div>

                {{-- BOTONES --}}
                <div class="d-flex gap-2 mt-4">

                    <button type="submit" class="btn btn-catalogo flex-fill">
                        <i class="bi bi-save me-2"></i>
                        Guardar producto
                    </button>

                    <a href="{{ route('admin.productos') }}" class="btn btn-catalogo flex-fill">
                        <i class="bi bi-x-circle me-2"></i>
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- JS (lo dejás igual, no lo tocamos porque es funcional) --}}
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
        });
    });

    document.addEventListener('click', () => {
        container.classList.remove('active');
    });
});
</script>

@endsection