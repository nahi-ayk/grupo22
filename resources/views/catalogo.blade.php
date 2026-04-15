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
        <title> catalogo </title>
    </head>
    <body>
        <p> hola </p>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5">
            <div class="col">
                <div class="card h-100">
                <img src="{{ asset('img/catalogo/ajedrez.jpg') }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Ajedrez de Madera</h5>
                    <p class="card-text">$20.000</p>
                    <a href="#" class="btn btn-primary">Agregar</a>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>