<!-- platilla para vistas -->
<!DOCTYPE html>
<html>
    <!--links comunes-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v=19">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Pacifico&family=Shadows+Into+Light&family=Titan+One&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"
        >
    </head>

    <body class= "aparecer">
        <!--barra de navegacion con topbar-->
        <div class= "header">
            @include('partes.topbar')
            @include('partes.navbar')
        </div>

        <!--contenido-->
        <main>
            @yield('contenido')
        </main>

        <!--footer-->
        @include('partes.footer') 

        <!--java-->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>