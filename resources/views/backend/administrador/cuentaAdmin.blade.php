@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Panel Administrador</title>

<div class="container-fluid py-4">

    {{-- TITULO --}}
    <div class="mb-4">
        <h2 class="panel-titulo">Estadisticas Generales </h2>
        <p class="panel-subtitulo">
            Resumen general del sistema
        </p>
    </div>

    {{-- TARJETAS SUPERIORES --}}
    <div class="row g-4 mb-4">

        {{-- USUARIOS --}}
        <div class="col-md-4">
            <div class="card dashboard-card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">

                    <div>
                        <p class="dashboard-text mb-1">
                            Usuarios Totales
                        </p>

                        <h3 class="dashboard-number">
                            {{ $totalClientes }}
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-usuarios">
                        <i class="bi bi-people-fill"></i>
                    </div>

                </div>
            </div>
        </div>

        {{-- PRODUCTOS --}}
        <div class="col-md-4">
            <div class="card dashboard-card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">

                    <div>
                        <p class="dashboard-text mb-1">
                            Productos
                        </p>

                        <h3 class="dashboard-number">
                            {{ $totalProductos }}
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-productos">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>

                </div>
            </div>
        </div>

        {{-- PEDIDOS --}}
        <div class="col-md-4">
            <div class="card dashboard-card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">

                    <div>
                        <p class="dashboard-text mb-1">
                            Pedidos
                        </p>

                        <h3 class="dashboard-number">
                            {{ $totalPedidos }}
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-pedidos">
                        <i class="bi bi-bag-check-fill"></i>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- GRAFICOS --}}
    <div class="row g-4">

        {{-- INICIOS DE SESION --}}
        <div class="col-lg-8">
            <div class="card dashboard-card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="mb-4 graficos-text">
                        Inicios de sesión - Últimos 30 días
                    </h5>

                    <div class="chart-scroll">
                        <div class="fake-chart">

                            @foreach($logins as $login)
                                <div class="bar-group">

                                    <span class="bar-value">{{ $login->total }}</span>

                                    <div class="bar-container">
                                        <div class="bar"
                                            style="height: {{ ($login->total / $maxLogin) * 100 }}%;">
                                        </div>
                                    </div>

                                    <small>{{ \Carbon\Carbon::parse($login->dia)->format('d/m') }}</small>

                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- CONSULTAS Y COMPRAS --}}
        <div class="col-lg-4">
            <div class="card dashboard-card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="mb-4 graficos-text">
                        Actividad General
                    </h5>

                    <div class="activity-box mb-3">
                        <div>
                            <h6 class="mb-0">Compras realizadas</h6>
                            <small class="text-muted">
                                Últimos 30 días
                            </small>
                        </div>

                        <span class="activity-badge badge-compras">
                            {{ $comprasUltimos30Dias }}
                        </span>
                    </div>

                    <div class="activity-box mb-3">
                        <div>
                            <h6 class="mb-0">Consultas enviadas</h6>
                            <small class="text-muted">
                                Últimos 30 días
                            </small>
                        </div>

                        <span class="activity-badge badge-consultas">
                            {{ $consultasUltimos30Dias }}
                        </span>
                    </div>

                    <div class="activity-box">
                        <div>
                            <h6 class="mb-0">Usuarios nuevos</h6>
                            <small class="text-muted">
                                Últimos 30 días
                            </small>
                        </div>

                        <span class="activity-badge badge-usuarios">
                            {{ $clientesNuevos }}
                        </span>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection