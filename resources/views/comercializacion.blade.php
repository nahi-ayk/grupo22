<!--vista de sector COMERCIALIZACION-->
@extends('plantilla')
@section('contenido')

<!--titulo de pagina-->
<title>Comercialización</title>

<!--pequeña animacion-->
<section class= "comercio-conteiner aparecer">

    <!--titulos-->
    <h2 class= "titulo-bienvenida text-center">Cómo podés comprar en TN Toys!</h2>

    <!--Medios de pago-->
    <div class= "comercio-box">
        <h2 class="text-center subtitulo mb-4">Medios de pago</h2>

        <!--cards-->
        <div class="row text-center">

            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-cash-coin"></i>
                        <h5 class="card-title">Efectivo</h5>
                        <p class="card-text">
                            Podés abonar en efectivo al retirar en tienda.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-credit-card"></i>
                        <h5 class="card-title">Tarjetas</h5>
                        <p class="card-text">
                            Aceptamos tarjetas de crédito y débito.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-phone"></i>
                        <h5 class="card-title">Billeteras Virtuales</h5>
                        <p class="card-text">
                            Pagá con Mercado Pago y otras billeteras digitales.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Envios-->
    <div class="comercio-box">
        <h2 class="text-center subtitulo">Entrega</h2>

        <!--cards-->
        <div class="row text-center justify-content-center">

            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-shop"></i>
                        <h5 class="card-title">Entrega en el local</h5>
                        <p class="card-text">
                            Podes pasar a retirar tu producto por nuestro local.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-truck"></i>
                        <h5 class="card-title">Envios a todo el pais</h5>
                        <p class="card-text">
                            Hacemos envios a todas las provincias del pais.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Preguntas frecuentes-->
    <div class="comercio-box">
        <div class="row text-start acordeon-style">
            <h3>Preguntas frecuentes</h3>
            <div class="accordion" id="accordionExample">

                <!-- PREGUNTA 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">
                            ¿Cuánto tiempo tardan en la preparación y envío del producto?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            La preparación y despacho del pedido se realiza dentro de las 24 a 72 horas hábiles posteriores a la compra.
                        </div>
                    </div>
                </div>

                <!-- PREGUNTA 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo">
                            ¿Se puede hacer seguimiento del pedido?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Una vez finalizada la compra, recibirás un código de seguimiento por correo electrónico para poder controlar el estado de tu pedido en todo momento.
                        </div>
                    </div>
                </div>

                <!-- PREGUNTA 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseThree">
                            ¿Hay costos adicionales?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Los costos adicionales pueden variar según el método de envío, los impuestos aplicables y la provincia de destino.
                        </div>
                    </div>
                </div>

                <!-- PREGUNTA 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseFour">
                            ¿Hay reembolsos?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Los reembolsos son aplicables siempre que la solicitud se realice dentro de los plazos establecidos. Para más información, te recomendamos consultar nuestros Términos y Condiciones.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

@endsection