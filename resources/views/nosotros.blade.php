@extends('plantilla')
@section('contenido')
    <title> nosotros </title>
<body>
    <main class="seccion-sobre aparecer"> <h1 class="text-center titulo mt-4 mb-5">Sobre Nosotros</h1>
        <section class="contenido1 "> 
            <div class="container"> 
                <div class="row py-5 align-items-center">
                    <div class="col-md-6 ">
                        <h2 class="subtitulo">Nuestra Misión</h2>
                        <p class="w-100"> <!--w-100: Ajusta el texto para que se extienda un 100% de ancho-->
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
                <div class="row align-items-center py-5">
                    <div class="col-md-6 ">
                        <h2 class="subtitulo">Historia</h2>
                        <p class="w-100"> <!--w-100: Ajusta el texto para que se extienda un 100% de ancho-->
                        Nacimos con el objetivo de brindar alegría y fomentar la creatividad a través del juego, entendiendo su importancia en el desarrollo y aprendizaje. <br>
                        Desde nuestros inicios nos caracterizamos por escuchar al cliente y en mejorar en base a sus opiniones.
                        </p>
                    </div>
                
                    <div class="col-md-6  text-center">
                        <img src="{{ asset('img/logo2.png') }}" class="img-fluid img-mediana" alt="Tn Toys">
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
@endsection