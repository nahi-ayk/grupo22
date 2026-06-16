@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Productos</title>

<div class="container my-5">

    {{-- HEADER --}}
    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Productos</h1>
            <p class="panel-subtitulo">Gestión de productos en venta</p>
        </div>
    </div>

    {{-- RESUMEN --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="dashboard-text">Total Productos</p>
                        <h3 class="dashboard-number">{{ $totalProductos }}</h3>
                    </div>
                    <div class="dashboard-icon icono-usuarios">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="dashboard-text">Stock Mínimo</p>
                        <h3 class="dashboard-number">{{ $productosStockMinimo }}</h3>
                    </div>
                    <div class="dashboard-icon icono-productos">
                        <i class="bi bi-boxes"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="dashboard-text">Sin Stock</p>
                        <h3 class="dashboard-number">{{ $productosSinStock }}</h3>
                    </div>
                    <div class="dashboard-icon icono-pedidos">
                        <i class="bi bi-x-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- PANEL --}}
    <div class="panel-card">

        {{-- FILTROS (MISMO ESTILO QUE PEDIDOS/CONSULTAS) --}}
        <div class="panel-filtros">

            <form method="GET" action="{{ route('admin.productos') }}">

                <div class="row align-items-center g-3">

                    <div class="col-md-4">
                        <input type="text"
                               name="buscar"
                               class="form-control filtro-control"
                               placeholder="Buscar producto..."
                               value="{{ request('buscar') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="categoria" class="form-select filtro-control">

                            <option value="">Todas las categorías</option>

                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="estado" class="form-select filtro-control">

                            <option value="">Todos</option>
                            <option value="sin_stock">Sin stock</option>
                            <option value="stock_minimo">Stock mínimo</option>

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

        {{-- TABLA DE PRODUCTOS --}}
        <div class="table-scroll table-responsive">

            <table class="table panel-table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($productos as $producto)

                        <tr>

                            {{-- PRODUCTO --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">

                                    <img src="{{ $producto->imagen ? asset($producto->imagen) : asset('img/logo.png') }}"
                                        style="width:45px;height:45px;object-fit:cover;border-radius:10px;">

                                    <span class="fw-semibold">
                                        {{ $producto->nombre }}
                                    </span>

                                    @if($producto->id == $topProductoId)
                                        <span class="badge bg-danger ms-2">
                                            <i class="bi bi-fire"></i>Más vendido
                                        </span>
                                    @endif

                                </div>
                            </td>

                            {{-- CATEGORÍA --}}
                            <td class="text-secondary">
                                {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                            </td>

                            {{-- PRECIO --}}
                            <td class="fw-bold text-success">
                                ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                            </td>

                            {{-- STOCK --}}
                            <td>
                                {{ $producto->stock_actual }}
                            </td>

                            {{-- ESTADO --}}
                            <td>
                                @if($producto->stock_actual == 0)
                                    <span class="badge badge-pendiente">Sin stock</span>

                                @elseif($producto->stock_actual <= $producto->stock_minimo)
                                    <span class="badge bg-warning text-dark">Stock mínimo</span>

                                @else
                                    <span class="badge badge-compras">
                                        En Stock
                                    </span>
                                @endif
                            </td>

                            {{-- ACCIONES --}}
                            <td>
                                <a href="{{ route('producto.editar', $producto->id) }}"
                                class="btn btn-vermas-pedido btn-sm">
                                    <i class="bi bi-pencil"></i>Ver
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-box fs-2 d-block mb-2"></i>
                                No se encontraron productos.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

    {{-- BOTONES ABAJO --}}
        <div class="d-flex justify-content-end gap-2 mt-4">

            <a href="{{ route('crear.producto') }}" class="btn btn-catalogo">
                <i class="bi bi-plus-circle me-1"></i>
                Agregar producto
            </a>

            <a href="{{ route('admin.categorias.crear') }}" class="btn btn-catalogo">
                <i class="bi bi-tags me-1"></i>
                Agregar categoría
            </a>

        </div>
</div>

@endsection