<!-- topbar para las vistas -->
<div class="topbar">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <!--logo en letras de la empresa-->
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo2.png') }}" class='logo-empresa' height="40">
        </div>
        <!--buscador (sin funcionalidad por el momento)-->
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar...">
            <button class="btn btn-buscar">Buscar</button>
        </form>
        <!--iconos-->
        <div class="d-flex align-items-center gap-3 fs-4">
            <i class="bi bi-cart-fill icono-topbar"></i>

            <a href="/login">
                <i class="bi bi-person-circle icono-topbar"></i>
            </a>
        </div>
    </div>
</div>