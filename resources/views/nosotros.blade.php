@extends('plantilla')
@section('contenido')
    <title> Sobre Nosotros </title>
<body>
    <main class="seccion-sobre aparecer"> <h1 class="text-center titulo mt-4 mb-5">Sobre Nosotros</h1>
        <section class="contenido1 "> 
            <div class="container"> 
                <div class="row py-5 align-items-center">
                    <div class="col-md-6 ">
                        <h2 class="subtitulo">Nuestra Misión</h2>
                        <p class="w-100 descripcion-text"> <!--w-100: Ajusta el texto para que se extienda un 100% de ancho-->
                            <b>Tn Toys</b> es una juguetería que busca ofrecer los mejores productos con una excelente relación calidad-precio. 
                            Contamos con opciones para todas las edades, desde los más pequeños hasta adolescentes, incluyendo juegos de mesa, puzzles y juegos de ingenio.
                            <br>Trabajamos con una amplia variedad de marcas, seleccionando cuidadosamente cada producto para garantizar calidad, seguridad y diversión.
                        </p>
                    </div>

                    <div class="col-md-6  text-center">
                        <img src="{{ asset('img/logo.png') }}" class="img-fluid mb-3 img-mediana mt-4" alt="Logo Tn Toys">
                        <br>
                    </div>
                </div> 
            </div> 
        </section> 
            
        <section class="contenido2 ">
            <div class= "container ">
                <div class="row align-items-center py-5 flex-md-row-reverse">
                    <div class="col-md-6 ">
                        <h2 class="subtitulo">Historia</h2>
                        <p class="w-100 descripcion-text"> <!--w-100: Ajusta el texto para que se extienda un 100% de ancho-->
                        Nacimos con el objetivo de brindar alegría y fomentar la creatividad a través del juego, entendiendo su importancia en el desarrollo y aprendizaje. <br>
                        Desde nuestros inicios nos caracterizamos por escuchar al cliente y en mejorar en base a sus opiniones.
                        </p>
                    </div>
                
                    <div class="col-md-6  text-center">
                        <img src="{{ asset('img/local.png') }}" class="img-fluid img-mediana w-100" alt="Tn Toys">
                    </div>
                </div>
            </div>
        </section>

        <section class="contenido3 ">
            <div class= "container ">
                <div class="row align-items-center py-5">
                    <div class="col-md-6 ">
                        <h2 class="subtitulo">Ubicación</h2>
                    <p class="w-100 descripcion-text">
                    <i class="bi bi-geo-alt-fill"></i>
                    Av. 3 de Abril 57 Local 1, Corrientes
                    </p>
                    </div>
                
                    <div class="col-md-6  text-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d442.48413677715905!2d-58.85034152042465!3d-27.473209976732477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456d9140deb03f%3A0xf656a50e99825571!2sLa%20unidad!5e0!3m2!1ses!2sar!4v1776348436810!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </section>

    </main>
</body>
@endsection