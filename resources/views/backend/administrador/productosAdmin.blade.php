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

        {{-- TOTAL PRODUCTOS --}}
        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <p class="dashboard-text">
                            Total Productos
                        </p>

                        <h3 class="dashboard-number">
                            {{ $totalProductos }}
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-usuarios">
                        <i class="bi bi-box-seam"></i>
                    </div>

                </div>
            </div>
        </div>

        {{-- STOCK MINIMO --}}
        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <p class="dashboard-text">
                            Productos en Stock Mínimo
                        </p>

                        <h3 class="dashboard-number">
                            {{ $productosStockMinimo }}
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-productos">
                        <i class="bi bi-boxes"></i>
                    </div>

                </div>
            </div>
        </div>

        {{-- SIN STOCK --}}
        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <p class="dashboard-text">
                            Productos Sin Stock
                        </p>

                        <h3 class="dashboard-number">
                            {{ $productosSinStock }}
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-pedidos">
                        <i class="bi bi-x-circle"></i>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- FILTROS --}}
    <div class="filtros-productos">
        <form method="GET" action="{{ route('admin.productos') }}" class="row g-3">

            <div class="col-md-4">
                <input
                    type="text"
                    name="buscar"
                    class="form-control"
                    placeholder="Buscar producto..."
                    value="{{ request('buscar') }}"
                >
            </div>

            <div class="col-md-3">
                <select name="categoria" class="form-select">

                    <option value="">
                        Todas las categorías
                    </option>

                    @foreach($categorias as $categoria)

                        <option
                            value="{{ $categoria->id }}"
                            {{ request('categoria') == $categoria->id ? 'selected' : '' }}
                        >
                            {{ $categoria->nombre }}
                        </option>

                    @endforeach

                </select>
            </div>

            <div class="col-md-3">
                <select name="estado" class="form-select">

                    <option value="">
                        Todos los productos
                    </option>

                    <option
                        value="sin_stock"
                        {{ request('estado') == 'sin_stock' ? 'selected' : '' }}
                    >
                        Sin stock
                    </option>

                    <option
                        value="stock_minimo"
                        {{ request('estado') == 'stock_minimo' ? 'selected' : '' }}
                    >
                        Stock mínimo
                    </option>

                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-cliente w-100">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    {{-- LISTA DE PRODUCTOS --}}
    <div class="lista-clientes mt-4">

        @forelse($productos as $producto)

            <div class="cliente-card">

                <div class="cliente-info">

                    <img
                        src="{{ $producto->imagen ? asset($producto->imagen) : asset('img/logo.png') }}"
                        class="producto-miniatura"
                    >

                    <div>

                        <h5 class="cliente-nombre">
                            {{ $producto->nombre }}
                        </h5>

                        <p class="cliente-email mb-1">
                            Categoría:
                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                        </p>

                        <small class="cliente-fecha">
                            ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                        </small>

                    </div>

                </div>

                <div class="cliente-extra">

                    @if($producto->stock_actual == 0)

                        <div class="estado-inactivo">
                            Sin stock
                        </div>

                    @elseif($producto->stock_actual <= $producto->stock_minimo)

                        <div class="estado-pendiente">
                            Stock mínimo
                        </div>

                    @else

                        <div class="estado-activo">
                            {{ $producto->stock_actual }} en stock
                        </div>

                    @endif

                    <a href="{{ route('producto.editar', $producto->id) }}" class="btn btn-cliente">
                        Editar
                    </a>

                </div>

            </div>

        @empty

            <div class="alert alert-warning">
                No se encontraron productos.
            </div>

        @endforelse

    </div>

    {{-- BOTONES --}}
    <div class="contenedor-btn-producto">

        <a href="{{ route('crear.producto') }}" class="btn btn-agregar-producto">
            <i class="bi bi-plus-circle"></i>
            Agregar producto
        </a>

        <a href="{{ route('admin.categorias.crear') }}" class="btn btn-agregar-producto">
            <i class="bi bi-plus-circle"></i>
            Agregar Categoría
        </a>

    </div>

</div>

@endsection