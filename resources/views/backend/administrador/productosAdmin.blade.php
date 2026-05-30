@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Productos</title>

<div class="container-fluid py-4">

    {{-- TITULO --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="admin-titulo mb-1">
                Productos
            </h2>

            <p class="admin-subtitulo mb-0">
                Gestión de productos en venta
            </p>
        </div>

    </div>

    {{-- RESUMEN SUPERIOR --}}
    <div class="row g-4 mb-5">

        {{-- TOTAL CLIENTES --}}
        <div class="col-md-4">

            <div class="dashboard-card">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <p class="dashboard-text">
                            Total Productos
                        </p>

                        <h3 class="dashboard-number">
                            34
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-usuarios">
                        <i class="bi bi-box-seam"></i>
                    </div>

                </div>

            </div>

        </div>

        {{-- ACTIVOS --}}
        <div class="col-md-4">

            <div class="dashboard-card">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <p class="dashboard-text">
                            Productos en Stock Minimo
                        </p>

                        <h3 class="dashboard-number">
                            3
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-productos">
                        <i class="bi bi-boxes"></i>
                    </div>

                </div>

            </div>

        </div>

        {{-- NUEVOS --}}
        <div class="col-md-4">

            <div class="dashboard-card">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <p class="dashboard-text">
                            Productos Sin Stock
                        </p>

                        <h3 class="dashboard-number">
                            4
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-pedidos">
                        <i class="bi bi-x-circle"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- LISTA --}}
    <div class="lista-clientes mt-4">

        @for($i = 0; $i < 8; $i++)

        <div class="cliente-card">

            <div class="cliente-info">

                <img src="{{ asset('img/logo.png') }}"
                class="producto-miniatura">

                <div>

                    <h5 class="cliente-nombre">
                        Muñeco Pokémon
                    </h5>

                    <p class="cliente-email mb-1">
                        Categoría: Peluches
                    </p>

                    <small class="cliente-fecha">
                        $24.999
                    </small>

                </div>

            </div>

            <div class="cliente-extra">

                <div class="estado-activo">
                    En stock
                </div>

                <button class="btn btn-cliente">
                    Editar
                </button>

            </div>

        </div>

        @endfor

    </div>

    <div class="contenedor-btn-producto">

        <a href="{{ route('crear.producto') }}"
        class="btn btn-agregar-producto">

            <i class="bi bi-plus-circle"></i>
            Agregar producto
        </a>

        <a href="{{ route('admin.categorias.crear') }}"
        class="btn btn-agregar-producto">

            <i class="bi bi-plus-circle"></i>
            Agregar Categoria
        </a>

    </div>
</div>

@endsection