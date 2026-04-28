<!--vista para formulario de registro-->
@extends('plantilla-login-register') 
@section('contenido')

<!--titulo de pagina-->
<title>Registrarse</title>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  
  <div class="card login-card shadow">
    <div class="card-body">

      <!--icono de persona-->
      <div class="text-center">
        <i class="bi bi-person-fill fs-1"></i>
      </div>

      <div class="login-form">
        <form class="text-center">

          <h2 class="mb-4">Registrarse</h2>

          <!-- NOMBRE y APELLIDO -->
          <div class="row">
            <div class="col-md-6 mb-3 text-start">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3 text-start">
              <label class="form-label">Apellido</label>
              <input type="text" class="form-control" required>
            </div>
          </div>

            <!-- EMAIL -->
          <div class="mb-3 text-start">
              <label class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" required>
          </div>

            <!-- PASSWORD -->
          <div class="mb-3 text-start">
              <label class="form-label">Contraseña</label>

              <div class="password-wrapper">
                  <input type="password" class="form-control pe-5" id="password-register" required>

                  <i class="bi bi-eye password-toggle toggle-password"
                  data-target="password-register"></i>
              </div>
          </div>

            <!-- CONFIRM PASSWORD -->
          <div class="mb-3 text-start">
              <label class="form-label">Confirmar contraseña</label>

              <div class="password-wrapper">
                  <input type="password" class="form-control pe-5" id="password-confirm" required>

                  <i class="bi bi-eye password-toggle toggle-password"
                  data-target="password-confirm"></i>
              </div>
          </div>

          <!--link a inicio de sesion-->
          <p class="mt-3">
            ¿Ya tenés una cuenta? <a href="/login">Inicia sesión acá</a>
          </p>

          <!--boton para confirmar registro-->
          <div class="d-grid">
            <button type="submit" class="btn btn-inicio-sesion">
              Registrarse
            </button>
          </div>

          <!--boton de continuar como invitado-->
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