<!-- BOTÓN MOBILE -->
<button class="menu-toggle d-md-none" type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#sidebarMobile">

    <i class="bi bi-list"></i>
</button>

<div class="layout-backend">

    <!-- SIDEBAR DESKTOP -->
    <aside class="sidebar d-none d-md-flex">

        <div>
            <h2 class="saludo-sidebar">
                Hola,<br>
                {{ Auth::user()->nombre }}
            </h2>

            <nav class="menu-sidebar">

                @if(Auth::user()->rol_id == 1)

                    <a href="{{ route('admin.cuenta') }}">Estadísticas Generales</a>
                    <a href="{{ route('admin.clientes') }}">Clientes</a>
                    <a href="{{ route('admin.productos') }}">Productos</a>
                    <a href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                    <a href="{{ route('admin.consultas.index') }}">Consultas</a>

                @else

                    <a href="{{ route('cliente.cuenta') }}">Mis datos</a>
                    <a href="{{ route('cliente.compras') }}">Mis compras</a>
                    <a href="{{ route('cliente.carrito') }}">Mi carrito</a>
                    <a href="{{ route('cliente.favoritos')}}">Favoritos</a>

                @endif

            </nav>
        </div>

        <!-- USUARIO -->
        <div class="dropup usuario-sidebar">
            <button class="btn dropdown-toggle usuario-btn" type="button" data-bs-toggle="dropdown">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar-sidebar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <strong>{{ Auth::user()->nombre }}</strong>
                </div>
            </button>

            <ul class="dropdown-menu">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>

    </aside>

</div>

<!-- OFFCANVAS MOBILE -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMobile">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menú</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

        <h2 class="saludo-sidebar">
            Hola,<br>
            {{ Auth::user()->nombre }}
        </h2>

        <nav class="menu-sidebar">

            @if(Auth::user()->rol_id == 1)

                <a href="{{ route('admin.cuenta') }}">Estadísticas Generales</a>
                <a href="{{ route('admin.clientes') }}">Clientes</a>
                <a href="{{ route('admin.productos') }}">Productos</a>
                <a href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                <a href="{{ route('admin.consultas.index') }}">Consultas</a>

            @else

                <a href="{{ route('cliente.cuenta') }}">Mis datos</a>
                <a href="{{ route('cliente.compras') }}">Mis compras</a>
                <a href="{{ route('cliente.carrito') }}">Mi carrito</a>
                <a href="{{ route('cliente.favoritos')}}">Favoritos</a>

            @endif

        </nav>

    </div>

</div>