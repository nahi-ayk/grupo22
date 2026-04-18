@extends('plantilla')
@section('contenido')

<div class="container mt-4 mb-5">
    <h1 class="titulo-bienvenida text-center">Contacto</h1>
    <p class="texto-bienvenida text-center">
        Escríbinos y nuestro equipo te contactará a la brevedad
    </p>

    <div class="row justify-content-center mt-4">
        <div class="col-12 col-lg-10">

            <div class="contacto-box">

                <!-- IZQUIERDA -->
                <div class="contacto-info">
                    <h2 class="text-center mb-4">Información de contacto</h2>

                    <div class="mb-3">
                        <strong><i class="bi bi-telephone"></i> Teléfono</strong><br>
                        <span>+54 3794-382461</span>
                    </div>

                    <div class="mb-3">
                        <strong><i class="bi bi-geo-alt"></i> Dirección</strong><br>
                        <span>Shopping UniPlaza, Mariano Moreno 174 <br> Corrientes, Argentina</span>
                    </div>

                    <div class="mb-3">
                        <strong><i class="bi bi-envelope"></i> Email</strong><br>
                        <span>tntoysjugueteria@gmail.com</span>
                    </div>

                    <div class="mb-3">
                        <strong><i class="bi bi-clock"></i> Horarios de Atención</strong><br>
                        <span>Lun - Vie: 9:00 - 12:00 / 17:00 - 21:00</span><br>
                        <span>Sab: 9:00 - 13:00</span>
                    </div>
                </div>

                <!-- DERECHA -->
                <div class="contacto-form">
                    <h2 class="text-center mb-4">Envíanos un Mensaje</h2>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="Tu nombre" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="tu@email.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mensaje</label>
                            <textarea class="form-control" rows="5" placeholder="Tu mensaje" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-send"></i> Enviar mensaje
                        </button>
                    </form>
                </div>

            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-10">

                    <div class="texto-bienvenida text-center">Tambien podes visitarnos en nuestra tienda!</div>
                    <div class="mapa-box">
                        <div class="mapa-contenedor">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3539.874805199814!2d-58.853118125250916!3d-27.47315671685224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456d004ba98a27%3A0x2b7e56cba17acb34!2sUniPlaza!5e0!3m2!1ses!2sar!4v1776546128347!5m2!1ses!2sar" 
                                width="600" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection