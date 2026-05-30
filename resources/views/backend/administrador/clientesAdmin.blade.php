@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Clientes</title>

<div class="container-fluid py-4">

    {{-- TITULO --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="admin-titulo mb-1">
                Clientes
            </h2>

            <p class="admin-subtitulo mb-0">
                Gestión de usuarios registrados
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
                            Total Clientes
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

        {{-- ACTIVOS --}}
        <div class="col-md-4">

            <div class="dashboard-card">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <p class="dashboard-text">
                            Activos (últimos 30 dias)
                        </p>

                        <h3 class="dashboard-number">
                            {{ $clientesActivos }}
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-productos">
                        <i class="bi bi-person-check-fill"></i>
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
                            Nuevos este mes
                        </p>

                        <h3 class="dashboard-number">
                            {{ $clientesNuevos}}
                        </h3>
                    </div>

                    <div class="dashboard-icon icono-pedidos">
                        <i class="bi bi-stars"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- LISTA CLIENTES --}}
    <div class="lista-clientes">

        {{-- CLIENTE --}}
        @foreach($clientes as $cliente)

        <div class="cliente-card">

            {{-- IZQUIERDA --}}
            <div class="cliente-info">

                <div class="cliente-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div>

                    <h5 class="cliente-nombre">
                        {{ $cliente->nombre }}
                        {{ $cliente->apellido }}
                    </h5>

                    <p class="cliente-email mb-1">
                        {{ $cliente->email }}
                    </p>

                    <small class="cliente-fecha">
                        Registrado el
                        {{ $cliente->created_at->format('d/m/Y') }}
                    </small>

                </div>

            </div>

            {{-- DERECHA --}}
            <div class="cliente-extra">

                <div class="estado-activo">
                    Cliente
                </div>

                <div class="cliente-tiempo">
                    {{ $cliente->ultimo_login ? $cliente->ultimo_login->diffForHumans() : 'Sin datos' }}
                </div>

                <!--<button class="btn btn-cliente">
                    Ver más
                </button>-->

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection