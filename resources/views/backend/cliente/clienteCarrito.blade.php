@extends('backend.plantillaBackend')
@section('contenidoBackend')

<title>Mi Carrito</title>

<style>
    .color-primario { color: #515ec1 !important; }
    .btn-verde-compra { background-color: #2e9e63; border-color: #2e9e63; color: white; }
    .btn-verde-compra:hover { background-color: #258251; border-color: #258251; }
    .form-control:focus { border-color: #515ec1; box-shadow: 0 0 0 0.25rem rgba(81, 94, 193, 0.25); }
    .input-group-text { background-color: transparent; }
    
    /* Evita que el input readonly se vea gris */
    input[readonly].bg-white { background-color: #ffffff !important; }
</style>

<div class="container my-5" style="max-width: 950px;">
    
    <div class="mb-4">
        <h2 class="fw-bold admin-titulo">
            Mi Carrito
        </h2>

        <p class="admin-subtitulo">
            Tus productos seleccionados para tu proxima compra
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @forelse($items as $item)
        @if ($loop->first)
            <div class="table-responsive mb-4 admin-subtitulo">
                <table class="table align-middle border-top border-bottom" style="border-color: #dee2e6;">
                    <thead class="text-muted small">
                        <tr>
                            <th scope="col" class="py-3 fw-bold">Producto</th>
                            <th scope="col" class="py-3 fw-bold text-center">Precio unitario</th>
                            <th scope="col" class="py-3 fw-bold text-center">Cantidad</th>
                            <th scope="col" class="py-3 fw-bold text-center">Subtotal</th>
                            <th scope="col" class="py-3 fw-bold text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
        @endif

        <tr>
            <td class="py-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 border rounded" style="width: 60px; height: 60px; overflow: hidden;">
                        @if($item->producto->imagen)
                            <img src="{{ asset('img/catalogo/' . basename($item->producto->imagen)) }}" alt="{{ $item->producto->nombre }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-light">
                                <i class="bi bi-image fs-5"></i>
                            </div>
                        @endif
                    </div>
                    <div class="ms-3">
                        <span class="text-dark fw-medium text-uppercase" style="font-size: 0.9rem;">{{ $item->producto->nombre }}</span>
                    </div>
                </div>
            </td>
            <td class="text-center text-muted" style="font-size: 0.95rem;">
                ${{ number_format($item->precio_unitario, 2) }}
            </td>
            
            <td class="text-center">
                <form method="POST" action="{{ route('carrito.actualizar', $item->id) }}" class="d-flex justify-content-center align-items-center gap-2 m-0">
                    @csrf
                    @method('PUT')
                    
                    <div class="input-group input-group-sm flex-nowrap" style="width: 100px;">
                        <button type="button" class="btn btn-cantidad px-2" onclick="decrementarCantidad(this)">
                            <i class="bi bi-dash"></i>
                        </button>
                        
                        <input type="text" name="cantidad" class="form-control text-center px-1 bg-white fw-bold" value="{{ $item->cantidad }}" readonly>
                        
                        <button type="button" class="btn btn-cantidad px-2" onclick="incrementarCantidad(this)">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    
                    <button type="submit" class="btn btn-sm text-white shadow-sm" style="background-color: var(--azul);" title="Guardar cambios">
                        <i class="bi bi-arrow-repeat"></i>
                    </button>
                </form>
            </td>

            <td class="text-center fw-bold" style="font-size: 0.95rem; color: var(--azul);">
                ${{ number_format($item->subtotal, 2) }}
            </td>
            <td class="text-center">
                <form method="POST" action="{{ route('carrito.eliminar', $item->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn p-1 px-2 text-white" style="background-color: var(--rosa);" title="Eliminar producto">
                        <i class="bi bi-trash3"></i>
                    </button>
                </form>
            </td>
        </tr>

        @if ($loop->last)
                    </tbody>
                </table>
                <div class="d-flex justify-content-end align-items-center mt-3 pe-5">
                    <span class="me-4 fs-5 fw-bold admin-subtitulo fs-4">Total:</span>
                    <span class="fs-4 fw-bold">${{ number_format($carrito->total, 2) }}</span>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 mt-1 admin-subtitulo" style="transform: none !important;">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-4 pb-3 border-bottom" style="color: var(--azul);">
                        <i class="bi bi-credit-card-2-front me-2" style="color: var(--azul);"></i> Finalizar compra
                    </h5>
                    
                    <form method="POST" action="{{ route('carrito.confirmar') }}" id="form-checkout">
                        @csrf
                        
                        <div class="mb-4">
                            <p class="text-muted small fw-bold text-uppercase mb-3 tracking-wide" style="font-size: 0.75rem;">Datos de entrega</p>
                            
                            <div class="d-flex gap-4 mb-3 ps-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_entrega" id="entrega_retiro" value="retiro" checked>
                                    <label class="form-check-label text-dark fw-medium" for="entrega_retiro">
                                        Retiro en sucursal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_entrega" id="entrega_envio" value="envio">
                                    <label class="form-check-label text-dark fw-medium" for="entrega_envio">
                                        Envío a domicilio
                                    </label>
                                </div>
                            </div>

                            <div id="seccion-envio" class="d-none mt-3 bg-light p-4 rounded-3 border">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="direccion" class="form-label small text-muted fw-bold mb-1"><i class="bi bi-geo-alt me-1"></i> Dirección de entrega</label>
                                        <input type="text" class="form-control text-muted" id="direccion" name="direccion" placeholder="Ej: Av. Corrientes 1234, Depto 4">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control text-muted" id="provincia" name="provincia" placeholder="Provincia">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control text-muted" id="localidad" name="localidad" placeholder="Localidad">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control text-muted" id="codigo_postal" name="codigo_postal" placeholder="C.P.">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <p class="text-muted small fw-bold text-uppercase mb-3 tracking-wide" style="font-size: 0.75rem;">Datos de pago</p>
                            
                            <div class="row g-3 mb-4">
                                @foreach($metodosPago as $metodo)
                                    <div class="col-12 col-md-4">
                                        <div class="form-check border rounded p-3 h-100">
                                            <input class="form-check-input ms-0 me-2 selector-pago" 
                                                type="radio" 
                                                name="metodo_pago_id" 
                                                id="metodo{{ $metodo->id }}" 
                                                value="{{ $metodo->id }}" 
                                                data-tipo="{{ strtolower($metodo->descripcion) }}"
                                                {{ $loop->first ? 'checked' : '' }} required>
                                            <label class="form-check-label d-inline-block mt-1" for="metodo{{ $metodo->id }}">
                                                {{ $metodo->descripcion }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div id="seccion-tarjeta">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="numero_tarjeta" class="form-label small text-dark fw-medium mb-1">Número de tarjeta</label>
                                        <div class="input-group">
                                            <span class="input-group-text text-muted border-end-0 bg-white"><i class="bi bi-credit-card"></i></span>
                                            <input type="text" class="form-control border-start-0 ps-0" id="numero_tarjeta" name="numero_tarjeta" required placeholder="0000 0000 0000 0000" maxlength="19">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="nombre_titular" class="form-label small text-dark fw-medium mb-1">Nombre del titular</label>
                                        <input type="text" class="form-control" id="nombre_titular" name="nombre_titular" required placeholder="TAL COMO FIGURA EN LA TARJETA">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="vencimiento" class="form-label small text-dark fw-medium mb-1">Vencimiento</label>
                                        <input type="text" class="form-control" id="vencimiento" name="vencimiento" required placeholder="MM/AA" maxlength="5">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="cvv" class="form-label small text-dark fw-medium mb-1">CVV <i class="bi bi-question-circle text-muted ms-1" title="Código de seguridad de 3 o 4 dígitos"></i></label>
                                        <input type="password" class="form-control" id="cvv" name="cvv" required placeholder="•••" maxlength="4">
                                    </div>
                                </div>
                            </div>

                            <div id="seccion-alternativa" class="alert alert-info d-none mt-3 mb-0" style="border-radius: 12px;">
                                <i class="bi bi-info-circle me-2"></i> <span id="texto-alternativo"></span>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-verde-compra btn-lg w-100 py-3 shadow-sm rounded-3 fs-6 fw-bold">
                            <i class="bi bi-lock-fill me-2"></i> Confirmar compra - ${{ number_format($carrito->total, 2) }}
                        </button>
                        
                        <div class="text-center mt-4">
                            <a href="{{ url('/catalogo') }}" class="btn btn-catalogo rounded-pill px-4 py-2" style="font-size: 0.9rem;">
                                <i class="bi bi-arrow-left me-1"></i> Seguir comprando
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    @empty
        <div class="card text-center py-5 mt-4 admin-subtitulo">
            <i class="bi bi-cart-x text-muted mb-3" style="font-size: 4rem;"></i>
            <h4 class="fw-bold">Tu carrito está vacío</h4>
            <p class="text-muted">No hay productos en tu pedido actual.</p>
            
            <div>
                <a href="{{ url('/catalogo') }}" class="btn btn-catalogo mt-3 d-inline-block w-auto px-4">
                    Volver al Catálogo
                </a>
            </div>
        </div>
    @endforelse
</div>

<script>
    // Funciones exclusivas para los botones + y -
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
        // --- 1. LÓGICA DEL ENVÍO Y OCULTAR "EFECTIVO" ---
        const radioRetiro = document.getElementById('entrega_retiro');
        const radioEnvio = document.getElementById('entrega_envio');
        const seccionEnvio = document.getElementById('seccion-envio');
        const camposEnvio = seccionEnvio.querySelectorAll('input');
        
        // Buscamos dinámicamente el input de efectivo leyendo su atributo data-tipo
        const radioEfectivo = Array.from(document.querySelectorAll('.selector-pago'))
            .find(radio => radio.getAttribute('data-tipo').includes('efectivo'));
        
        // Encontramos automáticamente el contenedor padre (el div con clase col-12 col-md-4)
        const contenedorEfectivo = radioEfectivo ? radioEfectivo.closest('.col-12') : null;

        function toggleEnvioFields() {
            if (radioEnvio.checked) {
                // Lógica de mostrar formulario de envío
                seccionEnvio.classList.remove('d-none');
                camposEnvio.forEach(input => input.setAttribute('required', 'required'));
                
                // OCULTAR EFECTIVO
                if(contenedorEfectivo) contenedorEfectivo.style.display = 'none';
                if(radioEfectivo && radioEfectivo.checked) {
                    radioEfectivo.checked = false;
                    // Opcional: Seleccionar automáticamente el primer método de pago disponible para que no quede vacío
                    let primerPago = document.querySelector('.selector-pago:not(#pago_efectivo)');
                    if(primerPago) primerPago.checked = true;
                    actualizarFormularioPago(); // Refrescamos las secciones de pago
                }
            } else {
                // Lógica de ocultar formulario de envío
                seccionEnvio.classList.add('d-none');
                camposEnvio.forEach(input => {
                    input.removeAttribute('required');
                    input.value = '';
                });
                
                // MOSTRAR EFECTIVO NUEVAMENTE
                if(contenedorEfectivo) contenedorEfectivo.style.display = 'block';
            }
        }

        radioRetiro.addEventListener('change', toggleEnvioFields);
        radioEnvio.addEventListener('change', toggleEnvioFields);

        // --- 2. MÁSCARAS Y VALIDACIÓN DE TARJETA ---
        const inputVencimiento = document.getElementById('vencimiento');
        if(inputVencimiento) {
            // A) Máscara (lo que ya tenías)
            inputVencimiento.addEventListener('input', function(e) {
                let val = e.target.value.replace(/\D/g, '');
                if (val.length > 2) {
                    val = val.substring(0, 2) + '/' + val.substring(2, 4);
                }
                e.target.value = val;
            });

            // B) Validación de fecha al quitar el foco (blur) - NUEVO
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
                    alert("El mes ingresado no es válido.");
                    vencida = true;
                } else if (anioInput < anioActual) {
                    vencida = true;
                } else if (anioInput === anioActual && mesInput < mesActual) {
                    vencida = true;
                }

                if (vencida) {
                    alert("La tarjeta ingresada se encuentra vencida. Por favor, revisa los datos.");
                    this.value = ''; 
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        }

        const inputTarjeta = document.getElementById('numero_tarjeta');
        if(inputTarjeta) {
            inputTarjeta.addEventListener('input', function(e) {
                let val = e.target.value.replace(/\D/g, '');
                let v = val.match(/.{1,4}/g);
                if (v) {
                    e.target.value = v.join(' ');
                }
            });
        }

        // --- 3. LÓGICA DEL MÉTODO DE PAGO (Sin cambios) ---
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