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

                    <a href="{{ route('admin.cuenta') }}"
                        class="{{ request()->routeIs('admin.cuenta') ? 'activo' : '' }}">
                        Estadísticas Generales
                    </a>
                    <a href="{{ route('admin.clientes') }}"
                        class="{{ request()->routeIs('admin.clientes') ? 'activo' : '' }}">
                        Clientes
                    </a>
                    <a href="{{ route('admin.productos') }}"
                        class="{{ request()->routeIs('admin.productos') ? 'activo' : '' }}">
                        Productos
                    </a>
                    <a href="{{ route('admin.categorias') }}" 
                        class="{{ request()->routeIs('admin.categorias') ? 'activo' : '' }}">
                        Categorías
                    </a>
                    <a href="{{ route('admin.pedidos.index') }}"
                        class="{{ request()->routeIs('admin.pedidos.index') ? 'activo' : '' }}">
                        Pedidos
                    </a>
                    <a href="{{ route('admin.consultas.index') }}"
                        class="{{ request()->routeIs('admin.consultas.index') ? 'activo' : '' }}">
                        Consultas
                    </a>
                    <a href="{{ route('admin.tarifas.index') }}"
                        class="{{ request()->routeIs('admin.tarifas.index') ? 'activo' : '' }}">
                        Tarifas de Envio
                    </a>

                @else

                    <a href="{{ route('cliente.cuenta') }}"
                        class="{{ request()->routeIs('cliente.cuenta') ? 'activo' : '' }}">
                        Mis datos
                    </a>
                    <a href="{{ route('cliente.compras') }}"
                        class="{{ request()->routeIs('cliente.compras') ? 'activo' : '' }}">
                        Mis compras
                    </a>
                    <a href="{{ route('cliente.carrito') }}"
                        class="{{ request()->routeIs('cliente.carrito') ? 'activo' : '' }}">
                        Mi carrito
                    </a>
                    <a href="{{ route('cliente.favoritos')}}"
                        class="{{ request()->routeIs('cliente.favoritos') ? 'activo' : '' }}">
                        Favoritos
                    </a>

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

        <div class="mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Cerrar sesión
                </button>
            </form>
        </div>

    </div>

</div>