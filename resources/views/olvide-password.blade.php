@extends('plantilla-login-register') 
@section('contenido')

<title>Recuperar Contraseña</title>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  
  <div class="contacto-box" style="max-width: 520px; width: 100%;">
    
    <div class="contacto-form">

      <div class="text-center mb-3">
        <i class="bi bi-envelope-fill fs-1"></i>
      </div>

      <form class="text-center" method="POST" action="{{ route('password.email') }}">
        @csrf

        <h2 class="mb-4">Recuperar contraseña</h2>
        
        <p class="text-start mb-4 text-muted">
            Ingresá tu correo electrónico y te enviaremos un enlace seguro para crear una clave nueva.
        </p>

        @if(session('success'))
            <div class="alert alert-success text-start">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="mb-3 text-start">
          <label class="form-label">Correo electrónico</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required autofocus>
          @error('email')
              <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-catalogo">
            Enviar enlace
          </button>
        </div>

        <div class="d-grid mt-3">
          <a href="/login" class="btn btn-invitado">
            Volver al inicio de sesión
          </a>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection