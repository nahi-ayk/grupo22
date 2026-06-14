@extends('plantilla')

@section('contenido')

<title> Sobre Nosotros </title>

<div class="container mt-5">
    <p class="titulo-bienvenida text-center">Conocé nuestra historia y lo que nos inspira...</p>
</div>

<section class="nosotros-container">

    <div class="bloque-nosotros bloque-rosa">
        <div class="franja-superior">
            <h2>NUESTRA MISION</h2>
        </div>
        <div class="contenido-bloque">
            <div class="col-imagen">
                <img src="img/logo.png">
            </div>
            <div class="col-texto">
                <b>Tn Toys</b> es una juguetería pensada para acompañar cada etapa de la vida con diversión, creatividad y momentos para compartir. 
                Ofrecemos productos de excelente calidad a precios accesibles, para que niños, adolescentes y adultos encuentren algo que realmente disfruten. 
                Contamos con una amplia variedad de juguetes, juegos de mesa y desafíos de ingenio, ideales para compartir en familia, con amigos o incluso para disfrutar en solitario. 
                Seleccionamos cuidadosamente cada producto, priorizando siempre la calidad, la seguridad y la mejor experiencia para cada cliente. 
            </div>
        </div>
    </div>

    <div class="bloque-nosotros bloque-verde">
        <div class="franja-superior">
            <h2>NUESTRA HISTORIA</h2>
        </div>
        <div class="contenido-bloque">
            <div class="col-imagen">
                <img src="img/local.png">
            </div>
            <div class="col-texto">
                <b>Tn Toys</b> nació con un objetivo claro: brindar alegría y fomentar la creatividad a través del juego. 
                Creemos que jugar no solo es diversión, sino también aprendizaje, desarrollo y conexión entre personas, sin importar la edad. 
                Desde nuestros inicios nos involucramos en cada detalle: diseñamos nuestra identidad, creamos el logo y desarrollamos la página web para reflejar quiénes somos. 
                Escuchamos constantemente a nuestros clientes, porque creemos que una buena experiencia se construye juntos. 
            </div>
        </div>
    </div>

    <div class="bloque-nosotros bloque-celeste">
    <div class="franja-superior">
        <h2>STAFF</h2>
    </div>
    
    <div class="staff-slider">
        <div class="staff-track">
            
            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/fundador1.png') }}" class="img-fluid staff-img" alt="Tobias Sanchez">
                </div>
                <div class="col-texto">
                    <h3>Tobias Sanchez</h3>
                    <p class="puesto-staff">Cofundador</p>
                    <p>Parte del corazón de TN Toys, impulsando la magia y la diversión para que cada juguete llegue a los hogares de Corrientes.</p>
                </div>
            </div>

            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/fundador2.jpg') }}" class="img-fluid staff-img" alt="Nahiara Meza">
                </div>
                <div class="col-texto">
                    <h3>Nahiara Meza</h3>
                    <p class="puesto-staff">Cofundadora</p>
                    <p>Creadora y mente creativa detrás de TN Toys, buscando siempre acompañar cada etapa de la niñez con risas y juegos.</p>
                </div>
            </div>

            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/empleado1.png') }}" class="img-fluid staff-img" alt="Joaquín Herrera">
                </div>
                <div class="col-texto">
                    <h3>Joaquín Herrera</h3>
                    <p class="puesto-staff">Empleado</p>
                    <p>Encargado de que la experiencia en la tienda sea excelente, asesorando con la mejor onda para encontrar el regalo ideal.</p>
                </div>
            </div>

            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/empleado2.png') }}" class="img-fluid staff-img" alt="Valentina Ríos">
                </div>
                <div class="col-texto">
                    <h3>Valentina Ríos</h3>
                    <p class="puesto-staff">Encargada</p>
                    <p>Coordinando los pedidos y envíos para asegurar que la diversión y la magia de TN Toys lleguen siempre a tiempo.</p>
                </div>
            </div>

            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/empleado3.png') }}" class="img-fluid staff-img" alt="Martina Salazar">
                </div>
                <div class="col-texto">
                    <h3>Martina Salazar</h3>
                    <p class="puesto-staff">Empleado</p>
                    <p>Dedicada a la atención y cuidado de cada detalle, haciendo que el paso por nuestra juguetería sea un momento único.</p>
                </div>
            </div>


            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/fundador1.png') }}" class="img-fluid staff-img" alt="Tobias Sanchez">
                </div>
                <div class="col-texto">
                    <h3>Tobias Sanchez</h3>
                    <p class="puesto-staff">Cofundador</p>
                    <p>Parte del corazón de TN Toys, impulsando la magia y la diversión para que cada juguete llegue a los hogares de Corrientes.</p>
                </div>
            </div>

            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/fundador2.jpg') }}" class="img-fluid staff-img" alt="Nahiara Meza">
                </div>
                <div class="col-texto">
                    <h3>Nahiara Meza</h3>
                    <p class="puesto-staff">Cofundadora</p>
                    <p>Creadora y mente creativa detrás de TN Toys, buscando siempre acompañar cada etapa de la niñez con risas y juegos.</p>
                </div>
            </div>

            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/empleado1.png') }}" class="img-fluid staff-img" alt="Joaquín Herrera">
                </div>
                <div class="col-texto">
                    <h3>Joaquín Herrera</h3>
                    <p class="puesto-staff">Empleado</p>
                    <p>Encargado de que la experiencia en la tienda sea excelente, asesorando con la mejor onda para encontrar el regalo ideal.</p>
                </div>
            </div>

            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/empleado2.png') }}" class="img-fluid staff-img" alt="Valentina Ríos">
                </div>
                <div class="col-texto">
                    <h3>Valentina Ríos</h3>
                    <p class="puesto-staff">Encargada</p>
                    <p>Coordinando los pedidos y envíos para asegurar que la diversión y la magia de TN Toys lleguen siempre a tiempo.</p>
                </div>
            </div>

            <div class="staff-item-slide">
                <div class="col-imagen">
                    <img src="{{ asset('img/nosotros/empleado3.png') }}" class="img-fluid staff-img" alt="Martina Salazar">
                </div>
                <div class="col-texto">
                    <h3>Martina Salazar</h3>
                    <p class="puesto-staff">Empleado</p>
                    <p>Dedicada a la atención y cuidado de cada detalle, haciendo que el paso por nuestra juguetería sea un momento único.</p>
                </div>
            </div>

        </div>
    </div>
</div>

</section>

@endsection