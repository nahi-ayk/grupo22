@extends('plantilla')
@section('contenido')

<title> Sobre Nosotros </title>

<div class="container mt-5 text-center">
    <h2 class="titulo-bienvenida">Conocé nuestra historia y lo que nos inspira...</h2>
</div>

<section class="contenido1 aparecer"> 
    <div class="container rounded-4"> 
        <div class="row py-5 align-items-center">
            <div class="col-md-6">
                <h2 class="subtitulo">Nuestra Misión</h2>
                <p class="w-100 descripcion-text">
                    <b>Tn Toys</b> es una juguetería pensada para acompañar cada etapa de la vida con diversión, creatividad y momentos para compartir. Nos enfocamos en ofrecer productos de excelente calidad a precios accesibles, para que tanto niños como adolescentes y adultos puedan encontrar algo que disfruten.
                        Contamos con una amplia variedad que incluye juguetes, juegos de mesa, puzzles y desafíos de ingenio, ideales para jugar en familia, con amigos o incluso para desconectar y disfrutar en solitario.
                    <br>Seleccionamos cuidadosamente cada artículo de marcas confiables, priorizando siempre la calidad, la seguridad y, sobre todo, la diversión en cada experiencia.
                </p>
            </div>

            <div class="col-md-6  text-center">
                <img src="{{ asset('img/logo.png') }}" class="img-fluid mb-3 img-mediana mt-4" alt="Logo Tn Toys">
                <br>
            </div>
        </div> 
    </div> 
</section> 
    
<section class="contenido2 aparecer">
    <div class= "container ">
        <div class="row align-items-center py-5 flex-md-row-reverse">
            <div class="col-md-6 ">
                <h2 class="subtitulo">Historia</h2>
                <p class="w-100 descripcion-text"> 
                    Tn Toys nació con el objetivo de brindar alegría y fomentar la creatividad a través del juego, entendiendo su importancia en el desarrollo, el aprendizaje y también en los momentos de desconexión y disfrute, sin importar la edad.
                    Desde nuestros inicios nos involucramos en cada detalle del proyecto: diseñamos nuestro propio logo, construimos la identidad de la marca y desarrollamos la página web, con el propósito de reflejar lo que somos y lo que queremos transmitir. Cada decisión fue pensada para crear una experiencia cercana, moderna y auténtica.
                    Nos caracteriza la escucha constante hacia nuestros clientes, tomando sus opiniones como base para seguir mejorando, creciendo y adaptándonos, porque creemos que una buena experiencia se construye en conjunto.
                </p>
            </div>
        
            <div class="col-md-6  text-center">
                <img src="{{ asset('img/local.png') }}" class="img-fluid img-mediana w-100" alt="Tn Toys">
            </div>
        </div>
    </div>
</section>

<section class="contenido3 aparecer">
    <div class="container py-5">

        <h2 class="subtitulo mb-5">Nuestro Staff</h2>

        <!-- FUNDADORES -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/fundador1.jpg') }}" class="img-fluid staff-img mb-3" alt="Fundador 1">
                <h5>Tobias Sanchez</h5>
                <h8>Cofundador</h8>
            </div>

            <div class="col-md-4 text-center">
                <img src="{{ asset('img/nosotros/fundador2.jpg') }}" class="img-fluid staff-img mb-3" alt="Fundador 2">
                <h5>Nahiara Meza</h5>
                <h8>Cofundador</h8>
            </div>
        </div>

        <!-- EMPLEADOS -->
        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/empleado1.jpg') }}" class="img-fluid staff-img mb-3" alt="Empleado 1">
                <h5>Joaquín Herrera</h5>
                <h8>Encargado</h8>
            </div>

            <div class="col-md-4 text-center">
                <img src="{{ asset('img/empleado2.jpg') }}" class="img-fluid staff-img mb-3" alt="Empleado 2">
                <h5>Valentina Ríos</h5>
                <h8>Empleada</h8>
            </div>

            <div class="col-md-4 text-center">
                <img src="{{ asset('img/empleado3.jpg') }}" class="img-fluid staff-img mb-3" alt="Empleado 3">
                <h5>Martina Salazar</h5>
                <h8>Empleada</h8>
            </div>
        </div>

    </div>
</section>

@endsection