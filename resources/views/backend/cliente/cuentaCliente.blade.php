@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Mis Datos</title>

<div class="container my-5">

    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Mi Cuenta</h1>
            <p class="panel-subtitulo">
                Gestioná tu información personal
            </p>
        </div>
    </div>

    <div class="panel-card">

        <div class="panel-form">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('cliente.actualizar') }}">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control"
                            name="nombre"
                            value="{{ $usuario->nombre }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control"
                            name="apellido"
                            value="{{ $usuario->apellido }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control"
                            name="dni"
                            value="{{ $usuario->dni }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control"
                            name="email"
                            value="{{ $usuario->email }}">
                    </div>

                </div>

                <div class="form-separador"></div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control"
                            name="direccion"
                            placeholder="Dirección"
                            value="{{ $usuario->direccion->direccion ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Provincia</label>
                        <input type="text" class="form-control"
                            name="provincia"
                            placeholder="Provincia"
                            value="{{ $usuario->direccion->provincia ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Localidad</label>
                        <input type="text" class="form-control"
                            name="localidad"
                            placeholder="Localidad"
                            value="{{ $usuario->direccion->localidad ?? '' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Código Postal</label>
                        <input type="text" class="form-control"
                            name="codigo_postal"
                            placeholder="Cod. Postal"
                            value="{{ $usuario->direccion->codigo_postal ?? '' }}">
                    </div>

                    <div class="form-separador"></div>

                    <div class="row align-items-end">

                        <div class="col-md-8 mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password"
                                class="form-control"
                                value="********"
                                disabled>
                        </div>

                        <div class="col-md-4 mb-3">
                            <button type="button"
                                    class="btn btn-catalogo w-100"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#cambiarPassword">
                                <i class="bi bi-key me-1"></i>
                                Cambiar contraseña
                            </button>
                        </div>

                    </div>

                    <div class="collapse" id="cambiarPassword">

                        <div class="row mt-2">

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Contraseña actual</label>
                                <input type="password"
                                    name="password_actual"
                                    class="form-control">

                                @error('password_actual')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nueva contraseña</label>
                                <input type="password"
                                    name="password"
                                    class="form-control">
                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Confirmar contraseña</label>
                                <input type="password"
                                    name="password_confirmation"
                                    class="form-control">
                            </div>

                        </div>

                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-catalogo w-100">
                        Guardar cambios
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection