@extends('plantilla-login-register') 
@section('contenido')

<title>Crear Nueva Contraseña</title>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  
  <div class="contacto-box" style="max-width: 520px; width: 100%;">
    
    <div class="contacto-form">

      <div class="text-center mb-3">
        <i class="bi bi-key-fill fs-1"></i>
      </div>

      <form class="text-center" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <h2 class="mb-4">Crear nueva contraseña</h2>

        @if ($errors->any())
          <div class="alert alert-danger text-start">
            {{ $errors->first() }}
          </div>
        @endif

        <div class="mb-3 text-start">
          <label class="form-label">Nueva Contraseña</label>
          <div class="password-wrapper">
            <input type="password" name="password" class="form-control pe-5" id="password-reset" required>
            <i class="bi bi-eye password-toggle toggle-password" data-target="password-reset"></i>
          </div>
        </div>

        <div class="mb-4 text-start">
          <label class="form-label">Confirmar Contraseña</label>
          <div class="password-wrapper">
            <input type="password" name="password_confirmation" class="form-control pe-5" id="password-confirm" required>
            <i class="bi bi-eye password-toggle toggle-password" data-target="password-confirm"></i>
          </div>
        </div>

        <div class="d-grid mt-2">
          <button type="submit" class="btn btn-catalogo">
            Guardar contraseña
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection