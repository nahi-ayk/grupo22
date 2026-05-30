@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>mis_datos</title>

<div class="container-fluid py-4">

    <div class="card mi-cuenta-card">

        <div class="card-body">

            <h2 class="mi-cuenta-titulo">
                Mi cuenta
            </h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('cliente.actualizar') }}">
                @csrf
                @method('PUT')

                <!-- DATOS PERSONALES -->
                <h5 class="seccion-titulo">
                    DATOS PERSONALES
                </h5>

                <div class="row">

                    <!-- nombre -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Nombre"
                            name="nombre"
                            value="{{ $usuario->nombre }}"
                        >

                    </div>

                    <!-- apellido -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Apellido
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Apellido"
                            name="apellido"
                            value="{{ $usuario->apellido }}"
                        >

                    </div>

                    <!-- dni -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            DNI
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="DNI"
                            name="dni"
                            value="{{ $usuario->dni }}"
                        >

                    </div>

                    <!-- correo -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Correo electrónico
                        </label>

                        <input 
                            type="email"
                            class="form-control"
                            placeholder="Correo electrónico"
                            name="email"
                            value="{{ $usuario->email }}"
                        >

                    </div>

                </div>

                <!-- DATOS DE ENVIO -->
                <h5 class="seccion-titulo mt-4">
                    DATOS DE ENVÍO
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Dirección
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Dirección"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Provincia
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Provincia"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Localidad
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Localidad"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Cod. Postal
                        </label>

                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Cod. Postal"
                        >

                    </div>

                </div>

                <!-- BOTON -->
                <div class="text-center mt-4">

                    <button type="submit" class="btn btn-guardar px-5">
                        Guardar cambios
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection