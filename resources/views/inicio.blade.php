<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Pacifico&family=Shadows+Into+Light&display=swap" rel="stylesheet">
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
            <button class="btn btn-light">Buscar</button>
            </form>

            <div class="d-flex align-items-center gap-3 fs-4">
            <a href="#">👤</a>
            <a href="#">🛒</a>
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
                <a class="nav-link" href="#">CATALOGO</a>
                <a class="nav-link" href="#">COMO COMPRAR?</a>
                <a class="nav-link" href="#">NOSOTROS</a>
                <!--<a class="nav-link disabled" aria-disabled="true">Disabled</a> -->
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
    </body>
</html>
         