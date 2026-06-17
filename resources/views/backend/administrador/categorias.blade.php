@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Categorias</title>

<div class="container my-5">

    <div class="panel-header mb-3">
        <div>
            <h3 class="panel-titulo mb-0">Categorías</h3>
            <p class="panel-subtitulo mb-0">
                Gestión de categorías de productos
            </p>
        </div>
    </div>

    <div class="panel-card mb-4">
        <div class="panel-filtros">

            <form method="GET" action="{{ route('admin.categorias') }}">

                <div class="row align-items-center g-3">

                    <div class="col-md-4">
                        <input type="text"
                            name="buscar"
                            class="form-control filtro-control"
                            placeholder="Buscar categoría..."
                            value="{{ request('buscar') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="estado" class="form-select filtro-control">

                            <option value=""
                                {{ request('estado') == '' ? 'selected' : '' }}>
                                Todos
                            </option>

                            <option value="activo"
                                {{ request('estado') == 'activo' ? 'selected' : '' }}>
                                Activas
                            </option>

                            <option value="inactivo"
                                {{ request('estado') == 'inactivo' ? 'selected' : '' }}>
                                Inactivas
                            </option>

                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-catalogo w-100">
                            Buscar
                        </button>
                    </div>

                </div>

            </form>

        </div>
    

        {{-- TABLA DE CATEGORÍAS --}}
        <div class="table-scroll table-responsive">

            <table class="table panel-table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Productos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categorias as $categoria)

                        <tr>

                            <td>{{ $categoria->id }}</td>

                            <td>
                                <span class="fw-semibold {{ !$categoria->activo ? 'text-muted text-decoration-line-through' : '' }}">
                                    {{ $categoria->nombre }}
                                </span>
                            </td>

                            <td>
                                {{ $categoria->productos->count() }}
                            </td>

                            <td>
                                <div class="d-flex justify-content-center">

                                    @if($categoria->activo)

                                        <form action="{{ route('categoria.baja', $categoria->id) }}"
                                            method="POST">
                                            @csrf

                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm"
                                                    title="Dar de baja">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>

                                    @else

                                        <form action="{{ route('categoria.alta', $categoria->id) }}"
                                            method="POST">
                                            @csrf

                                            <button type="submit"
                                                    class="btn btn-outline-success btn-sm"
                                                    title="Dar de alta">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>

                                    @endif

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="text-center py-4 text-muted">
                                No hay categorías registradas.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- BOTON ABAJO --}}
    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('admin.categorias.crear') }}" class="btn btn-catalogo">
            <i class="bi bi-tags me-1"></i>
            Agregar categoría
        </a>
    </div>
</div>

@endsection