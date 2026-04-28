<!-- platilla para registro e inicio de sesion -->
<!DOCTYPE html>

<html>
    <!--links comunes-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Pacifico&family=Shadows+Into+Light&family=Titan+One&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    <!--cuerpo con animacion-->
    <body class= "aparecer">
        <main>
            @yield('contenido')
        </main>

        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!--script comun para funcionalidad de contraseña-->
        <script>
            document.addEventListener('click', function (e) {
                const toggle = e.target.closest('.toggle-password');
                if (!toggle) return;

                const input = document.getElementById(toggle.dataset.target);
                if (!input) return;

                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';

                toggle.classList.toggle('bi-eye');
                toggle.classList.toggle('bi-eye-slash');
            });
        </script>

    </body>
</html>