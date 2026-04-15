<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v=13">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Pacifico&family=Shadows+Into+Light&family=Titan+One&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <title> inicio </title>
    </head>
    <body>
        <div class="topbar">
            <div class="container-fluid d-flex align-items-center justify-content-between">

                <div class="d-flex align-items-center">
                <img src="{{ asset('img/logo2.png') }}" height="40">
                </div>

                <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar...">
                <button class="btn btn-buscar">Buscar</button>
                </form>

                <div class="d-flex align-items-center gap-3 fs-4">
                    <i class="bi bi-cart-fill icono-topbar"></i>
                    <i class="bi bi-person-circle icono-topbar"></i>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">INICIO</a>
                <a class="nav-link" href="/catalogo">CATALOGO</a>
                <a class="nav-link" href="#">COMO COMPRAR</a>
                <a class="nav-link" href="#">NOSOTROS</a>
            </div>
            </div>
        </div>
        </nav>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="{{ asset('img/c1.jpg') }}" class="d-block w-100">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('img/c2.jpg') }}" class="d-block w-100">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('img/c3.jpg') }}" class="d-block w-100">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

        </div>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <div class="container mt-5 text-center">
            <h2 class="titulo-bienvenida">¡Bienvenidos a TN Toys!</h2>
            <p class="texto-bienvenida">
                Encontra en Nuestra Tienda...
            </p>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="row g-0">
                    <div class="col-4">
                        <div id="carruselNiños" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="{{ asset('img/dinoC1.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="{{ asset('img/barbC1.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="{{ asset('img/hwC1.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carruselNiños" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carruselNiños" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                        <h5 class="card-title">Juguetes Para Niños!</h5>
                        <p class="card-text">En TN Toys vas a encontrar todo para hacer felices a los más pequeños, desde mágicos castillos de princesas hasta divertidas pistas de autos</p>
                        <a href="#" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="row g-0">
                    <div class="col-4">
                        <div id="carruselBebes" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="{{ asset('img/bebeC2.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="{{ asset('img/camC2.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="{{ asset('img/famC2.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carruselBebes" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carruselBebes" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                        <h5 class="card-title">Juguetes De Primera Infancia!</h5>
                        <p class="card-text">En TN Toys encontrá los mejores juguetes didácticos para bebés, ideales para estimular sus sentidos y desarrollar sus habilidades.</p>
                        <a href="#" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="row g-0">
                    <div class="col-4">
                        <div id="carruselJuegos" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="{{ asset('img/bastaC3.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="{{ asset('img/ajeC3.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="{{ asset('img/jengC3.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carruselJuegos" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carruselJuegos" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                        <h5 class="card-title">Juegos De Mesa!</h5>
                        <p class="card-text">En TN Toys encontrá una gran variedad de juegos de mesa ideales para compartir en familia o con amigos, divertirse y crear momentos inolvidables.</p>
                        <a href="#" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="row g-0">
                    <div class="col-4">
                        <div id="carruselFiguras" class="carousel slide carousel-fade carousel-card" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="{{ asset('img/leviC4.jpg') }}" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                <img src="{{ asset('img/batC4.jpg') }}" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                <img src="{{ asset('img/fpC4.jpg') }}" class="d-block w-100">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carruselFiguras" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carruselFiguras" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                        <h5 class="card-title">Figuras De Colección</h5>
                        <p class="card-text">En TN Toys descubrí figuras de colección de tus personajes favoritos, ideales para fans que buscan sumar piezas únicas y especiales a su colección.</p>
                        <a href="#" class="btn btn-categoria mt-auto">Ver categoría</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="container mt-3 text-center">
            <p class="texto-bienvenida">
                Y Mucho Mas!!...
            </p>
            <a href="#" class="btn btn-catalogo mt-auto">VER CATALOGO COMPLETO</a>
        </div>

        <footer class="footer mt-5">
            <div class="container py-4">
                <div class="row">

                <div class="col-md-3 d-flex align-items-center">
                    <img src="{{ asset('img/logo.png') }}" class="logo-footer">
                </div>

                <div class="col-md-3">
                    <h5>NAVEGACIÓN</h5>
                    <ul class="list-unstyled">
                        <li><a href="/">Inicio</a></li>
                        <li><a href="/sobre-mi">Catalogo</a></li>
                        <li><a href="/contacto">Nosotros</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>IMPORTANTE</h5>
                    <ul class="list-unstyled">
                    <li><a href="#">Términos y condiciones</a></li>
                    <li><a href="#">Política de privacidad</a></li>
                    <li><a href="#">Envíos</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>CONTACTO</h5>
                    <p>
                        <i class="bi bi-envelope-fill"></i>
                        tntoysjugueteria@gmail.com
                    </p>
                    <p>
                        <i class="bi bi-whatsapp"></i>
                        3794-382461
                    </p>
                    <p>
                        <i class="bi bi-instagram"></i>
                        @tntoys_jugueteria
                    </p>
                    <p>
                        <i class="bi bi-facebook"></i>
                        @tntoys_jugueteria
                    </p>
                </div>

                </div>
            </div>
        </footer>
    </body>
</html>
         