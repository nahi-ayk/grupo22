@extends('backend.plantillaBackend')

@section('contenidoBackend')

<title>Tarifas de Envío</title>

<div class="container my-5">

    {{-- HEADER --}}
    <div class="panel-header">
        <div>
            <h1 class="panel-titulo">Tarifas de Envío</h1>
            <p class="panel-subtitulo">Gestioná las zonas y precios de envío</p>
        </div>
    </div>

    {{-- CARD --}}
    <div class="panel-card">

        <div class="panel-form">

            {{-- FORM CREAR --}}
            <form action="{{ route('admin.tarifas.store') }}" method="POST" class="row g-2 mb-4">
                @csrf

                <div class="col-md-5">
                    <input type="text"
                           name="zona"
                           class="form-control"
                           placeholder="Zona (Ej: Centro, Interior)">
                </div>

                <div class="col-md-4">
                    <input type="number"
                           name="precio"
                           class="form-control"
                           placeholder="Precio de envío">
                </div>

                 <div class="col-md-3 d-flex">
                    <button class="btn btn-catalogo w-100 h-100">
                        <i class="bi bi-plus-circle me-2"></i>
                        Agregar
                    </button>
                </div>

            </form>

            <div class="form-separador"></div>

            {{-- LISTADO --}}
            <table class="table align-middle mt-3">
                <thead>
                    <tr>
                        <th>Zona</th>
                        <th>Precio</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tarifas as $tarifa)

                    <tr>

                        {{-- ZONA --}}
                        <td>
                            <form action="{{ route('admin.tarifas.update', $tarifa->id) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @method('PUT')

                                <input type="text"
                                    name="zona"
                                    class="form-control form-control-sm"
                                    value="{{ $tarifa->zona }}">
                        </td>

                        {{-- PRECIO --}}
                        <td>
                            <input type="number"
                                name="precio"
                                class="form-control form-control-sm"
                                value="{{ $tarifa->precio }}">
                        </td>

                        {{-- ACCIONES --}}
                        <td class="text-end">

                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.tarifas.destroy', $tarifa->id) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </td>

                    </tr>

                    @endforeach
                    </tbody>
            </table>

        </div>

    </div>

</div>

@endsection