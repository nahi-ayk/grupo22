<aside class="sidebar">

    <div>

        <h2 class="saludo-sidebar">
            Hola,<br>
            {{ Auth::user()->nombre }}
        </h2>

        <nav class="menu-sidebar">

            @if(Auth::user()->rol_id == 1)

                <a href="{{ route('admin.cuenta') }}">Estadisticas Generales</a>
                <a href="{{ route('admin.clientes') }}">Clientes</a>
                <a href="{{ route('admin.productos') }}">Productos</a>
                <a href="">Pedidos</a>
                <a href="{{ route('admin.consultas.index') }}">Consultas</a>

            @else

                <a href="{{ route('cliente.cuenta') }}">Mis datos</a>
                <a href="{{ route('cliente.compras') }}">Mis compras</a>
                <a href="{{ route('cliente.carrito') }}">Mi carrito</a>
                <a href="#">Favoritos</a>

            @endif

        </nav>

    </div>

    <div class="dropup usuario-sidebar">

        <button class="btn dropdown-toggle usuario-btn" 
                type="button" 
                data-bs-toggle="dropdown" 
                aria-expanded="false">

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

                    <button type="submit" class="dropdown-item">
                        Cerrar sesión
                    </button>
                </form>
            </li>

        </ul>

    </div>

</aside>