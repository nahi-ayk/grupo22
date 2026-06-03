@extends('plantilla') 
@section('contenido')

<title>Catalogo</title>

<div class= "container mt-3 text-center">
    <p class= "titulo-bienvenida">
        Bienvenido a Nuestro Catalogo!!
    </p>
    <p class= "texto-bienvenida">
        Aca vas a poder ver todos los productos que tenemos para vos!
    </p>
</div>

<div class="container mt-4">

    <div class="filtros-catalogo">

        <a href="{{ route('catalogo') }}"
        class="btn-filtro">
            Todas
        </a>

        @foreach($categorias as $categoria)

            <a href="{{ route('catalogo.categoria', $categoria->id) }}"
            class="btn-filtro">

                {{ $categoria->nombre }}

            </a>

        @endforeach

    </div>

</div>

<div class="container mt-4 mb-5">
    <div class="row catalogo row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">

        @foreach($productos as $producto)

        <div class="col">
            <div class="card producto-card h-100">

                @if(auth()->check())

                    <form action="{{ route('favoritos.toggle', $producto->id) }}"
                        method="POST">

                        @csrf

                        <button type="submit" class="btn-favorito">

                            <i class="bi {{ in_array($producto->id, $favoritos) ? 'bi-heart-fill' : 'bi-heart' }}"></i>

                        </button>

                    </form>

                @else

                    <a href="{{ url('/login') }}" class="btn-favorito">

                        <i class="bi bi-heart"></i>

                    </a>

                @endif

                <img src="{{ asset($producto->imagen) }}"
                class="card-img-top"
                    alt="{{ $producto->nombre }}">
                <div class="card-body">

                    <h5 class="card-title">
                        {{ $producto->nombre }}
                    </h5>

                    <p class="precio">
                        ${{ number_format($producto->precio_venta, 0, ',', '.') }}
                    </p>

                    <div class="acciones-producto">

                        <a href="{{ route('producto.mostrar', $producto->id) }}"
                        class="btn btn-vermas">
                            Ver Más
                        </a>

                        {{-- Botón Inicial de "Agregar" que no envía el formulario todavía --}}
                        <button type="button" class="btn btn-carrito" id="btn-falso-{{ $producto->id }}" onclick="mostrarCantidad({{ $producto->id }})">
                            <i class="bi bi-cart-plus"></i>
                            Agregar
                        </button>

                        {{-- El formulario original permanece intacto, pero oculto al principio con d-none --}}
                        <form action="{{ route('carrito.agregar') }}" method="POST" id="form-carrito-{{ $producto->id }}" class="d-none">
                            @csrf 
                            
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                            <div class="d-flex align-items-center gap-2">
                            <input type="number" 
                            name="cantidad" 
                            value="1" 
                            min="1" 
                            max="{{ $producto->stock_actual }}" 
                            class="form-control" 
                            style="width: 70px;"
                            oninput="
           // 1. Si está vacío (porque borró), permitimos que borre para escribir de nuevo
           if(this.value === '') return; 
           
           // 2. Si el primer dígito es un 0, lo borramos automáticamente
           if(this.value.startsWith('0')) this.value = this.value.replace(/^0+/, '');
           
           // 3. Restringimos a un máximo de 3 dígitos (puedes cambiar el 3 por 2 si nadie va a comprar más de 99 unidades)
           if(this.value.length > 2) this.value = this.value.slice(0, 2);
           
           // 4. Si después de las correcciones quedó en 0 o menos, lo reseteamos a 1
           if(parseInt(this.value) < 1) this.value = 1;
       "
       onblur="
           // Por seguridad: si el usuario hace clic afuera y dejó el campo vacío, se formatea a 1
           if(this.value === '') this.value = 1;
       ">

                                <button type="submit" class="btn btn-carrito">
                                    <i class="bi bi-cart-plus"></i>
                                    Agregar
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>

{{-- Script simple para alternar la visibilidad sin romper estilos --}}
<script>
function mostrarCantidad(id) {
    // Oculta el botón inicial solitario
    document.getElementById('btn-falso-' + id).classList.add('d-none');
    
    // Muestra el formulario original con el input de cantidad y el botón real de submit
    const form = document.getElementById('form-carrito-' + id);
    form.classList.remove('d-none');
}
</script>

@endsection