<!--vista para sector nosotros-->
@extends('plantilla')
@section('contenido')

<!--titulo de pagina-->
<title> Sobre Nosotros </title>

<!--titulo del cuerpo-->
<div class="container mt-5">
    <h2 class="titulo-bienvenida text-center">Conocé nuestra historia y lo que nos inspira...</h2>
</div>

<!--mision-->
<section class="contenido1 aparecer"> 
    <div class="container rounded-4"> 
        <div class="row py-5 align-items-center">
            <div class="col-md-6">
                <h2 class="subtitulo">Nuestra Misión</h2>
                <p class="descripcion-text">
                    <b>Tn Toys</b> es una juguetería pensada para acompañar cada etapa de la vida con diversión, creatividad y momentos para compartir.
                </p>

                <p class="descripcion-text">
                    Ofrecemos productos de excelente calidad a precios accesibles, para que niños, adolescentes y adultos encuentren algo que realmente disfruten.
                </p>

                <p class="descripcion-text">
                    Contamos con una amplia variedad de juguetes, juegos de mesa y desafíos de ingenio, ideales para compartir en familia, con amigos o incluso para disfrutar en solitario.
                </p>

                <p class="descripcion-text">
                    Seleccionamos cuidadosamente cada producto, priorizando siempre la calidad, la seguridad y la mejor experiencia para cada cliente.
                </p>
            </div>

            <div class="col-md-6  text-center">
                <img src="{{ asset('img/logo.png') }}" class="img-fluid mb-3 img-mediana mt-4" alt="Logo Tn Toys">
                <br>
            </div>
        </div> 
    </div> 
</section> 
    
<!--historia-->
<section class="contenido2 aparecer">
    <div class="container ">
        <div class="row align-items-center py-5 flex-md-row-reverse">
            <div class="col-md-6 ">
                <h2 class="subtitulo">Historia</h2>
                <p class="descripcion-text">
                    <b>Tn Toys</b> nació con un objetivo claro: brindar alegría y fomentar la creatividad a través del juego.
                </p>

                <p class="descripcion-text">
                    Creemos que jugar no solo es diversión, sino también aprendizaje, desarrollo y conexión entre personas, sin importar la edad.
                </p>

                <p class="descripcion-text">
                    Desde nuestros inicios nos involucramos en cada detalle: diseñamos nuestra identidad, creamos el logo y desarrollamos la página web para reflejar quiénes somos.
                </p>

                <p class="descripcion-text">
                    Escuchamos constantemente a nuestros clientes, porque creemos que una buena experiencia se construye juntos.
                </p>
                            </div>
        
            <div class="col-md-6  text-center">
                <img src="{{ asset('img/local.png') }}" class="img-fluid img-mediana w-100" alt="Tn Toys">
            </div>
        </div>
    </div>
</section>

<!--staff-->
<section class="contenido3 aparecer mb-5">
    <div class="container py-5">

        <h2 class="subtitulo mb-5">Nuestro Staff</h2>

        <!-- FUNDADORES -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/nosotros/fundador1.png') }}" class="img-fluid staff-img mb-3" alt="Fundador 1">
                <h5>Tobias Sanchez</h5>
                <p class="text-muted">Cofundador</p>
            </div>

            <div class="col-md-4 text-center">
                <img src="{{ asset('img/nosotros/fundador2.jpg') }}" class="img-fluid staff-img mb-3" alt="Fundador 2">
                <h5>Nahiara Meza</h5>
                <p class="text-muted">Cofundadora</p>
            </div>
        </div>

        <!-- EMPLEADOS -->
        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/nosotros/empleado1.png') }}" class="img-fluid staff-img mb-3" alt="Empleado 1">
                <h5>Joaquín Herrera</h5>
                <p class="text-muted">Empleado</p>
            </div>

            <div class="col-md-4 text-center">
                <img src="{{ asset('img/nosotros/empleado2.png') }}" class="img-fluid staff-img mb-3" alt="Empleado 2">
                <h5>Valentina Ríos</h5>
                <p class="text-muted">Encargada</p>
            </div>

            <div class="col-md-4 text-center">
                <img src="{{ asset('img/nosotros/empleado3.png') }}" class="img-fluid staff-img mb-3" alt="Empleado 3">
                <h5>Martina Salazar</h5>
                <p class="text-muted">Empleado</p>
            </div>
        </div>

    </div>
</section>

@endsection