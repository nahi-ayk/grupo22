@extends('plantilla') 
@section('contenido')

<title>Registrarse</title>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  
  <div class="card login-card shadow">
    <div class="card-body">

        <div class="text-center">
        <i class="bi bi-person-fill fs-1"></i>
        </div>

    <div class="login-form">
    <form class="text-center">
        <h2 class="mb-4">Registrarse</h2>
        
        <div class="mb-3 text-start"> <label for="exampleInputEmail1" class="form-label">Nombre</label>
        <input type="nombre" class="form-control" required>
        </div>
        
        <div class="mb-3 text-start">
        <label for="exampleInputPassword1" class="form-label">Apellido</label>
        <input type="apellido" class="form-control" required>
        </div>

        <div class="mb-3 text-start"> <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
        <input type="email" class="form-control" id="exampleInputEmail1" required>
        </div>
        
        <div class="mb-3 text-start">
        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" required>
        </div>

        <div class="mb-3 text-start">
        <label for="exampleInputPassword1" class="form-label">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" required>
        </div>
    
        <div class="d-grid"> <button type="submit" class="btn btn-primary">Registrarse</button>
        </div>
        
        
    </form>
    </div>
    </div>
</div>
</div>

@endsection