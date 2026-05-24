@extends('plantilla-login-register') 
@section('contenido')

<title>Iniciar Sesión</title>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  
  <div class="card login-card shadow">
    <div class="card-body">

      <div class="text-center">
        <i class="bi bi-person-fill fs-1"></i>
      </div>
        
      <div class="login-form">

        <form class="text-center" method="POST" action="/login">
          @csrf
        
          <h2 class="mb-4">Iniciar sesión</h2>
          
          <!-- EMAIL -->
          <div class="mb-3 text-start">
            <label class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" required
              oninvalid="this.setCustomValidity('Ingresá un email válido')"
              oninput="this.setCustomValidity('')">
          </div>
          
          <!-- PASSWORD -->
          <div class="mb-3 text-start password-wrapper">
            <label class="form-label">Contraseña</label>
            
            <div class="position-relative">
              <input type="password" name="password" class="form-control pe-5" id="password-login" required
                oninvalid="this.setCustomValidity('Ingresá tu contraseña')"
                oninput="this.setCustomValidity('')">

              <i class="bi bi-eye password-toggle toggle-password"
                data-target="password-login"></i>
            </div>
          </div>

          <!-- ERROR -->
          @if ($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          <p class="mt-3">
            ¿No tenés una cuenta? <a href="{{ url('/register') }}">Registrate acá</a>
          </p>

          <div class="d-grid">
            <button type="submit" class="btn btn-inicio-sesion">
              Iniciar sesión
            </button>
          </div>

          <div class="d-grid mt-4">
            <a href="/" class="btn btn-outline-secondary">
              Continuar como invitado
            </a>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

@endsection