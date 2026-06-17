@extends('backend.plantillaBackend')
@section('contenidoBackend')

<div class="container my-5 carrito-container">
    
    <div class="mb-4">
        <h1 class="panel-titulo">Mi Carrito</h1>
        <p class="panel-subtitulo">Tus productos seleccionados para tu próxima compra</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm panel-alerta" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm panel-alerta" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @forelse($items as $item)
        @if ($loop->first)
            <div class="table-responsive mb-4 panel-card">
                <table class="table panel-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3">Producto</th>
                            <th scope="col" class="py-3 text-center">Precio unitario</th>
                            <th scope="col" class="py-3 text-center">Cantidad</th>
                            <th scope="col" class="py-3 text-center">Subtotal</th>
                            <th scope="col" class="py-3 text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
        @endif

                        <tr>
                            <td class="py-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 border carrito-img">
                                        @if($item->producto->imagen)
                                            <img src="{{ asset('img/catalogo/' . basename($item->producto->imagen)) }}"
                                                 alt="{{ $item->producto->nombre }}"
                                                 class="w-100 h-100 object-fit-cover imagen-producto">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-light border-radius-8">
                                                <i class="bi bi-image fs-5"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        <span class="text-uppercase panel-subtitulo">
                                            {{ $item->producto->nombre }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center fw-bold text-muted">
                                ${{ number_format($item->precio_unitario, 2) }}
                            </td>

                            <td class="text-center">
                                <form method="POST"
                                      action="{{ route('carrito.actualizar', $item->id) }}"
                                      class="d-flex justify-content-center align-items-center gap-2 m-0">
                                    @csrf
                                    @method('PUT')

                                    <div class="input-group input-group-sm flex-nowrap carrito-cantidad">
                                        <button type="button" class="btn btn-outline-secondary px-2" onclick="decrementarCantidad(this)">
                                            <i class="bi bi-dash"></i>
                                        </button>

                                        <input type="text"
                                               name="cantidad"
                                               class="form-control text-center px-1 bg-white fw-bold"
                                               value="{{ $item->cantidad }}"
                                               readonly>

                                        <button type="button" class="btn btn-outline-secondary px-2" onclick="incrementarCantidad(this)">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm" title="Guardar cambios">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </form>
                            </td>

                            <td class="text-center fw-bold text-muted">
                                ${{ number_format($item->subtotal, 2) }}
                            </td>

                            <td class="text-center">
                                <form method="POST" action="{{ route('carrito.eliminar', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-1 px-2 btn-eliminar-carrito rounded" title="Eliminar producto">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

        @if ($loop->last)
                    </tbody>
                </table>

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center panel-footer pe-md-5 ps-md-4">
                    
                    <form method="POST" action="{{ route('carrito.vaciar') }}" class="m-0 mb-3 mb-sm-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-eliminar-carrito shadow-sm rounded px-3" title="Vaciar todo el carrito">
                            <i class="bi bi-trash3-fill me-1"></i> Vaciar Carrito
                        </button>
                    </form>

                    <div class="d-flex align-items-center">
                        <span class="me-4 fs-4 fw-bold texto-bienvenida">Total:</span>
                        <span class="fs-4 fw-bold panel-subtitulo">
                            ${{ number_format($carrito->total, 2) }}
                        </span>
                    </div>

                </div>
            </div>
            <div class="card panel-card mt-4 carrito-card">
                <div class="card-body panel-form">

                    <h5 class="fw-bold pb-3 mb-4 text-uppercase border-bottom">
                        <i class="bi bi-credit-card-2-front me-2 texto-rosa"></i>
                        Finalizar compra
                    </h5>

                    <form method="POST" action="{{ route('carrito.confirmar') }}" id="form-checkout">
                        @csrf

                        <div class="mb-4">
                            <p class="text-muted small fw-bold text-uppercase mb-3 tracking-wide checkout-label">
                                Datos de entrega
                            </p>

                            <div class="d-flex gap-4 mb-3 ps-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_entrega" id="entrega_retiro" value="retiro" checked>
                                    <label class="form-check-label fw-medium" for="entrega_retiro">
                                        Retiro en sucursal
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_entrega" id="entrega_envio" value="envio">
                                    <label class="form-check-label fw-medium" for="entrega_envio">
                                        Envío a domicilio
                                    </label>
                                </div>
                            </div>

                            <div id="seccion-envio" class="d-none mt-3 p-4 envio-box">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="direccion" class="form-label small mb-1">
                                            <i class="bi bi-geo-alt me-1"></i> Dirección de entrega
                                        </label>
                                        <input type="text"
                                               class="form-control"
                                               id="direccion"
                                               name="direccion"
                                               placeholder="Ej: Av. Corrientes 1234, Depto 4"
                                               value="{{ old('direccion', Auth::user()->direccion->direccion ?? '') }}">
                                    </div>

                                    <div class="col-md-5">
                                        <label for="provincia" class="form-label small mb-1">Provincia</label>
                                        <input type="text"
                                               class="form-control"
                                               id="provincia"
                                               name="provincia"
                                               placeholder="Provincia"
                                               value="{{ old('provincia', Auth::user()->direccion->provincia ?? '') }}">
                                    </div>

                                    <div class="col-md-5">
                                        <label for="localidad" class="form-label small mb-1">Localidad</label>
                                        <input type="text"
                                               class="form-control"
                                               id="localidad"
                                               name="localidad"
                                               placeholder="Localidad"
                                               value="{{ old('localidad', Auth::user()->direccion->localidad ?? '') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="codigo_postal" class="form-label small mb-1">C.P.</label>
                                        <input type="text"
                                               class="form-control"
                                               id="codigo_postal"
                                               name="codigo_postal"
                                               placeholder="C.P."
                                               value="{{ old('codigo_postal', Auth::user()->direccion->codigo_postal ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <p class="text-muted small fw-bold text-uppercase mb-3 tracking-wide checkout-label">
                                Datos de pago
                            </p>

                            <div class="row g-3 mb-4">
                                @foreach($metodosPago as $metodo)
                                    <div class="col-12 col-md-4">
                                        <div class="form-check border rounded p-3 h-100 metodo-pago">
                                            <input class="form-check-input ms-0 me-2 selector-pago"
                                                   type="radio"
                                                   name="metodo_pago_id"
                                                   id="metodo{{ $metodo->id }}"
                                                   value="{{ $metodo->id }}"
                                                   data-tipo="{{ strtolower($metodo->descripcion) }}"
                                                   {{ $loop->first ? 'checked' : '' }}
                                                   required>
                                            <label class="form-check-label d-inline-block mt-1 text-dark" for="metodo{{ $metodo->id }}">
                                                {{ $metodo->descripcion }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div id="seccion-tarjeta">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="numero_tarjeta" class="form-label small mb-1">Número de tarjeta</label>
                                        <div class="input-group">
                                            <span class="input-group-text border-0 bg-light">
                                                <i class="bi bi-credit-card"></i>
                                            </span>
                                            <input type="text"
                                                   class="form-control"
                                                   id="numero_tarjeta"
                                                   name="numero_tarjeta"
                                                   required
                                                   placeholder="0000 0000 0000 0000"
                                                   maxlength="19">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="nombre_titular" class="form-label small mb-1">Nombre del titular</label>
                                        <input type="text"
                                               class="form-control"
                                               id="nombre_titular"
                                               name="nombre_titular"
                                               required
                                               placeholder="TAL COMO FIGURA EN LA TARJETA">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="vencimiento" class="form-label small mb-1">Vencimiento</label>
                                        <input type="text"
                                               class="form-control"
                                               id="vencimiento"
                                               name="vencimiento"
                                               required
                                               placeholder="MM/AA"
                                               maxlength="5">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="cvv" class="form-label small mb-1">
                                            CVV <i class="bi bi-question-circle text-muted ms-1" title="Código de seguridad de 3 o 4 dígitos"></i>
                                        </label>
                                        <input type="password"
                                               class="form-control"
                                               id="cvv"
                                               name="cvv"
                                               required
                                               placeholder="•••"
                                               maxlength="4">
                                    </div>
                                </div>
                            </div>

                            <div id="seccion-alternativa" class="alert alert-info d-none mt-3 mb-0 alert-pago panel-alerta">
                                <i class="bi bi-info-circle me-2"></i>
                                <span id="texto-alternativo"></span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100 py-3 shadow-sm rounded-3 fs-6 fw-bold text-uppercase">
                            <i class="bi bi-lock-fill me-2"></i>
                            Confirmar compra - ${{ number_format($carrito->total, 2) }}
                        </button>

                        <div class="text-center mt-4">
                            <a href="{{ url('/catalogo') }}" class="btn btn-catalogo">
                                <i class="bi bi-arrow-left me-1"></i> Seguir comprando
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        @endif

    @empty
        <div class="card text-center py-5 mt-4 panel-card">
            <div class="card-body">
                <i class="bi bi-cart-x text-muted mb-3 icono-carrito-vacio"></i>
                <h4 class="fw-bold panel-titulo fs-2 mb-2">Tu carrito está vacío</h4>
                <p class="panel-subtitulo fs-5 mb-4">No hay productos en tu pedido actual.</p>
                <a href="{{ url('/catalogo') }}" class="btn btn-catalogo">
                    Volver al Catálogo
                </a>
            </div>
        </div>
    @endforelse
</div>

<script>
    function incrementarCantidad(btn) {
        let input = btn.previousElementSibling;
        input.value = parseInt(input.value) + 1;
    }

    function decrementarCantidad(btn) {
        let input = btn.nextElementSibling;
        if(parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const radioRetiro = document.getElementById('entrega_retiro');
        const radioEnvio = document.getElementById('entrega_envio');
        const seccionEnvio = document.getElementById('seccion-envio');
        const camposEnvio = seccionEnvio.querySelectorAll('input');
        
        const radioEfectivo = Array.from(document.querySelectorAll('.selector-pago'))
            .find(radio => radio.getAttribute('data-tipo').includes('efectivo'));
        
        const contenedorEfectivo = radioEfectivo ? radioEfectivo.closest('.col-12') : null;

        function toggleEnvioFields() {
            if (radioEnvio.checked) {
                seccionEnvio.classList.remove('d-none');
                camposEnvio.forEach(input => input.setAttribute('required', 'required'));
                
                if(contenedorEfectivo) contenedorEfectivo.style.display = 'none';
                if(radioEfectivo && radioEfectivo.checked) {
                    radioEfectivo.checked = false;
                    let primerPago = document.querySelector('.selector-pago:not(#pago_efectivo)');
                    if(primerPago) primerPago.checked = true;
                    actualizarFormularioPago();
                }
            } else {
                seccionEnvio.classList.add('d-none');
                camposEnvio.forEach(input => {
                    input.removeAttribute('required');
                    input.value = '';
                });
                if(contenedorEfectivo) contenedorEfectivo.style.display = 'block';
            }
        }

        radioRetiro.addEventListener('change', toggleEnvioFields);
        radioEnvio.addEventListener('change', toggleEnvioFields);

        // --- INICIO CÓDIGO VENCIMIENTO TARJETA ---
        const inputVencimiento = document.getElementById('vencimiento');
        
        if(inputVencimiento) {
            inputVencimiento.addEventListener('input', function(e) {
                let val = e.target.value.replace(/\D/g, '');
                if (val.length > 2) {
                    val = val.substring(0, 2) + '/' + val.substring(2, 4);
                }
                e.target.value = val;
            });

            inputVencimiento.addEventListener('blur', function() {
                const valor = this.value;
                if (!valor.includes('/')) return;

                const partes = valor.split('/');
                const mesInput = parseInt(partes[0], 10);
                const anioInput = parseInt(partes[1], 10);

                const fechaActual = new Date();
                const mesActual = fechaActual.getMonth() + 1; 
                const anioActual = parseInt(fechaActual.getFullYear().toString().slice(-2), 10);

                let vencida = false;

                if (mesInput < 1 || mesInput > 12) {
                    Swal.fire({
                        title: 'Mi Juguetería',
                        text: 'El mes ingresado no es válido.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                    vencida = true;
                } else if (anioInput < anioActual) {
                    vencida = true;
                } else if (anioInput === anioActual && mesInput < mesActual) {
                    vencida = true;
                }

                if (vencida) {
                    Swal.fire({
                        title: 'Tn Toys',
                        text: 'La tarjeta ingresada se encuentra vencida. Por favor, revisa los datos.',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: 'rgb(107, 214, 161)'
                    });
                    this.value = ''; 
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        }
        // --- FIN CÓDIGO VENCIMIENTO TARJETA ---

        // --- INICIO CÓDIGO NÚMERO DE TARJETA ---
        const inputTarjeta = document.getElementById('numero_tarjeta');
        if(inputTarjeta) {
            // 1. Bloqueamos cualquier tecla que no sea un número
            inputTarjeta.addEventListener('keypress', function(e) {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });

            // 2. Formateamos en grupos de a 4 mientras escribe o pega texto
            inputTarjeta.addEventListener('input', function(e) {
                let val = e.target.value.replace(/\D/g, ''); // Nos aseguramos de limpiar si pega texto
                let v = val.match(/.{1,4}/g); // Agrupamos de a 4
                e.target.value = v ? v.join(' ') : ''; // Unimos con espacios o vaciamos el input
            });
        }
        
        // Repetimos el bloqueo numérico para el CVV
        const inputCvv = document.getElementById('cvv');
        if (inputCvv) {
            inputCvv.addEventListener('keypress', function(e) {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });
        }
        // --- FIN CÓDIGO NÚMERO DE TARJETA ---

        const radiosPago = document.querySelectorAll('.selector-pago');
        const seccionTarjeta = document.getElementById('seccion-tarjeta');
        const inputsTarjetaData = seccionTarjeta ? seccionTarjeta.querySelectorAll('input') : [];
        const seccionAlternativa = document.getElementById('seccion-alternativa');
        const textoAlternativo = document.getElementById('texto-alternativo');

        function actualizarFormularioPago() {
            const seleccionado = document.querySelector('.selector-pago:checked');
            if(!seleccionado) return;

            const tipo = seleccionado.getAttribute('data-tipo');
            const esTarjeta = tipo.includes('tarjeta') || tipo.includes('crédito') || tipo.includes('débito') || tipo.includes('credito') || tipo.includes('debito');

            if (esTarjeta) {
                seccionTarjeta.classList.remove('d-none');
                seccionAlternativa.classList.add('d-none');
                inputsTarjetaData.forEach(input => input.setAttribute('required', 'required'));
            } else {
                seccionTarjeta.classList.add('d-none');
                seccionAlternativa.classList.remove('d-none');
                inputsTarjetaData.forEach(input => input.removeAttribute('required'));

                if (tipo.includes('transferencia')) {
                    textoAlternativo.innerHTML = "<strong>Transferencia Bancaria:</strong> Al confirmar, te brindaremos los datos para realizar el pago.";
                } else if (tipo.includes('efectivo') || tipo.includes('sucursal')) {
                    textoAlternativo.innerHTML = "<strong>Pago al retirar:</strong> Abonarás el monto total directamente en el mostrador.";
                } else {
                    textoAlternativo.innerHTML = "Serás redirigido a la plataforma segura para completar tu pago.";
                }
            }
        }

        actualizarFormularioPago();
        radiosPago.forEach(radio => {
            radio.addEventListener('change', actualizarFormularioPago);
        });
    });
</script>

@endsection