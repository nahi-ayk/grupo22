@extends('plantilla')
@section('contenido')
<title> Contacto </title>
<body>
    <main class="container aparecer">
        <div class="mt-4 mb-5">
            <h1 class="text-center titulo">Contacto</h1>
            <p class="text-center descripcion-text">Escríbinos y nuestro equipo te contactara a la brevedad</p>
         
            <div class="row mt-4 justify-content-center g-5">
                <!-- Card izquierda -->
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card p-4 h-100 c1">
                        <h2 class="descripcion-text">Información de contacto</h2><br>
                        <div class="text-sp">
                        <div class="mb-3">
                            <strong><i class="bi bi-telephone"></i>Teléfono</strong><br>
                            <span>+54 3795 024212</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-geo-alt"></i>Dirección</strong><br>
                            <span>Corrientes, Argentina</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-envelope"></i>Email</strong><br>
                            <span>TnToys@gmail.com</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-clock"></i>Horarios de Atención</strong><br>
                            <span>Lun - Vie: 9:00 - 18:00</span><br>
                            <span>Sab: 9:00 - 13:00</span>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Card derecha -->
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card mi-formulario h-100">
                        <div class="card-body">
                            <h2 class="descripcion-text">Envíanos un Mensaje</h2>
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

                                <button type="submit" class="btn btn-success"><i class="bi bi-send"></i>
                                    Enviar mensaje
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    
</body>
@endsection