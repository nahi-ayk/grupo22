@extends('plantilla-login-register') 

@section('contenido')

<title>Registrarse</title>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  
  <div class="card login-card shadow">
    <div class="card-body p-3">

      <!-- icono -->
      <div class="text-center">
        <i class="bi bi-person-fill fs-3"></i>
      </div>

      <div class="login-form">

        <form action="/register" method="POST" class="text-center">

          @csrf

          <h5 class="mb-3">Registrarse</h5>

          <!-- errores -->
          @if ($errors->any())
            <div class="alert alert-danger text-start">

              <ul class="mb-0">

                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach

              </ul>

            </div>
          @endif

          <!-- nombre y apellido -->
          <div class="row">

            <div class="col-md-6 mb-2 text-start">
              <label class="form-label">Nombre</label>

              <input 
                type="text" 
                name="nombre"
                class="form-control"
                value="{{ old('nombre') }}"
                required
              >
            </div>

            <div class="col-md-6 mb-2 text-start">
              <label class="form-label">Apellido</label>

              <input 
                type="text"
                name="apellido"
                class="form-control"
                value="{{ old('apellido') }}"
                required
              >
            </div>

          </div>

          <!-- dni -->
          <div class="mb-2 text-start">

            <label class="form-label">
              DNI
            </label>

            <input 
              type="text"
              name="dni"
              class="form-control"
              value="{{ old('dni') }}"
              required
            >

          </div>

          <!-- email -->
          <div class="mb-2 text-start">

            <label class="form-label">
              Correo electrónico
            </label>

            <input 
              type="email"
              name="email"
              class="form-control"
              value="{{ old('email') }}"
              required
            >

          </div>

          <!-- contraseña y confirmar -->
          <div class="row">

            <div class="col-md-6 mb-2 text-start">

              <label class="form-label">
                Contraseña
              </label>

              <div class="password-wrapper">

                <input 
                  type="password"
                  name="password"
                  class="form-control pe-5"
                  id="password-register"
                  required
                >

                <i 
                  class="bi bi-eye password-toggle toggle-password"
                  data-target="password-register">
                </i>

              </div>

            </div>

            <div class="col-md-6 mb-2 text-start">

              <label class="form-label">
                Confirmar contraseña
              </label>

              <div class="password-wrapper">

                <input 
                  type="password"
                  name="password_confirmation"
                  class="form-control pe-5"
                  id="password-confirm"
                  required
                >

                <i 
                  class="bi bi-eye password-toggle toggle-password"
                  data-target="password-confirm">
                </i>

              </div>

            </div>

          </div>

          <!-- login -->
          <p class="mt-2">
            ¿Ya tenés una cuenta? 
            
            <a href="/login">
              Inicia sesión acá
            </a>
          </p>

          <!-- botón -->
          <div class="d-grid">

            <button type="submit" class="btn btn-inicio-sesion">
              Registrarse
            </button>

          </div>

          <!-- invitado -->
          <div class="d-grid mt-2">

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