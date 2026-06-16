<!-- topbar para las vistas -->
<div class="topbar">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <!--logo en letras de la empresa-->
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo2.png') }}" class='logo-empresa' height="40">
        </div>
        <!--buscador (sin funcionalidad por el momento)-->
        <form class="d-flex position-relative"
            action="{{ route('buscar') }}"
            method="GET">

            <input
                id="buscador"
                class="form-control me-2"
                type="search"
                name="buscar"
                placeholder="Buscar..."
            >

            <button class="btn btn-buscar" type="submit">
                Buscar
            </button>

            <div id="resultados-busqueda" class="lista-resultados"></div>

        </form>
        <!--iconos-->
        <div class="d-flex align-items-center gap-3 fs-4">
            @auth
                @if(Auth::user()->rol->nombre === 'admin')
                    <a href="{{ route('admin.cuenta') }}">
                        <i class="bi bi-person-circle icono-topbar"></i>
                    </a>
                @else

                    <a href="{{ route('cliente.carrito') }}">
                        <i class="bi bi-cart-fill icono-topbar"></i>
                    </a>
                    
                    <a href="{{ route('cliente.cuenta') }}">
                        <i class="bi bi-person-circle icono-topbar"></i>
                    </a>


                @endif

            @else

                <a href="{{ url('/login') }}">
                    <i class="bi bi-person-circle icono-topbar"></i>
                </a>
            @endauth
        </div>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', () => {

    const buscador = document.getElementById('buscador');
    const resultados = document.getElementById('resultados-busqueda');

    if(!buscador) return;

    buscador.addEventListener('keyup', function() {

        let texto = this.value;

        if(texto.length < 2){
            resultados.innerHTML = '';
            return;
        }

        fetch(`/buscar-productos?q=${texto}`)
            .then(response => response.json())
            .then(data => {

                let html = '';

                data.forEach(producto => {

                    html += `
                        <a href="/producto/${producto.id}"
                        class="resultado-item">
                            ${producto.nombre}
                        </a>
                    `;

                });

                resultados.innerHTML = html;

            });

    });

});

</script>