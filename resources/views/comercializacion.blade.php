@extends('plantilla')
@section('contenido')
<title>Comercialización</title>

<section class= "comercio-conteiner aparecer">


<h2 class= "titulo-bienvenida text-center">Nuestra forma de trabajar</h2>

<!--Medios de pago-->
<div class= "comercio-box">
    <h2 class="text-center subtitulo mb-4">Medios de pago</h2>

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
</div>

    <!-- Envios-->
    <div class="comercio-box">
        <h2 class="text-center subtitulo">Entrega</h2>

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
                La preparación y despacho tarda entre 24 y 72 hs hábiles.
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
                Al momento de haber finalizado la compra se le enviara un código de seguimiento de pedido al cliente para que pueda controlarlo con su correo de preferencia.
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
                Dependen del envío, impuestos y provincia.
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
                El reembolso es aplicable siempre que la solicitud se realice dentro del horario establecido. Para mas información lea los Términos y condiciones
            </div>
        </div>
    </div>

</div>




    </div>
    </div>


</section>

@endsection