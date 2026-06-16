@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Clientes</title>

<div class="container my-5">

    {{-- HEADER --}}
    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Clientes</h1>
            <p class="panel-subtitulo">Gestión de usuarios registrados</p>
        </div>
    </div>

    {{-- RESUMEN --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="dashboard-text">Total Clientes</p>
                        <h3 class="dashboard-number">{{ $totalClientes }}</h3>
                    </div>
                    <div class="dashboard-icon icono-usuarios">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="dashboard-text">Activos (30 días)</p>
                        <h3 class="dashboard-number">{{ $clientesActivos }}</h3>
                    </div>
                    <div class="dashboard-icon icono-productos">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="dashboard-text">Nuevos este mes</p>
                        <h3 class="dashboard-number">{{ $clientesNuevos }}</h3>
                    </div>
                    <div class="dashboard-icon icono-pedidos">
                        <i class="bi bi-stars"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- PANEL --}}
    <div class="panel-card">

        {{-- FILTRO BUSCADOR --}}
        <div class="panel-filtros">

            <form method="GET" action="{{ route('admin.clientes') }}">

                <div class="row align-items-center g-3">

                    <div class="col-md-12 col-lg-6">

                        <div class="position-relative w-100" style="max-width: 300px;">

                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"
                               style="z-index: 5;"></i>

                            <input type="text"
                                   name="buscar"
                                   value="{{ request('buscar') }}"
                                   class="form-control filtro-control ps-5"
                                   placeholder="Buscar cliente por nombre...">

                        </div>

                    </div>

                    <div class="col-md-12 col-lg-6 text-end">

                        <button type="submit" class="btn btn-catalogo">
                            Buscar
                        </button>

                    </div>

                </div>

            </form>

        </div>

        {{-- TABLA CLIENTES --}}
        <div class="table-scroll table-responsive">

            <table class="table panel-table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Registro</th>
                        <th>Último acceso</th>
                        <th>Compras</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($clientes as $cliente)

                        <tr>

                            {{-- CLIENTE --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">

                                    <div class="cliente-avatar">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                    <span class="fw-semibold">
                                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                                    </span>

                                    @if($cliente->id == $topCompradorId)
                                        <span class="badge bg-danger ms-2">
                                            <i class="bi bi-fire"></i> Mejor Comprador
                                        </span>
                                    @endif

                                </div>
                            </td>

                            {{-- EMAIL --}}
                            <td class="text-secondary">
                                {{ $cliente->email }}
                            </td>

                            {{-- FECHA --}}
                            <td class="text-secondary small">
                                {{ $cliente->created_at->format('d/m/Y') }}
                            </td>

                            {{-- ÚLTIMO LOGIN --}}
                            <td class="text-secondary">
                                {{ $cliente->ultimo_login ? $cliente->ultimo_login->diffForHumans() : 'Sin datos' }}
                            </td>

                            <td class="fw-semibold text-dark">
                                {{ $cliente->pedidos_count }} compras
                            </td>

                            {{-- ESTADO --}}
                            <td>
                                <span class="badge badge-compras">
                                    Cliente
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                                No se encontraron clientes.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection