<!--vista de pantalla de inicio de sesion-->
@extends('plantilla-login-register') 
@section('contenido')

<!--titulo de pagina-->
<title>Iniciar Sesión</title>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  
  <!--icono de personita-->
  <div class="card login-card shadow">
    <div class="card-body">
        <div class="text-center">
          <i class="bi bi-person-fill fs-1"></i >
        </div>
        
      <div class="login-form">
        <form class="text-center">
        
          <!--texto-->
          <h2 class="mb-4">Iniciar sesión</h2>
          
          <!--campo de texto-->
          <div class="mb-3 text-start"> <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
            <input type="email" class="form-control" id="exampleInputEmail1" required
            oninvalid="if(this.validity.valueMissing){this.setCustomValidity('Ingresá tu email')} else if(this.validity.typeMismatch){this.setCustomValidity('El email debe ser válido')}"
            oninput="this.setCustomValidity('')">
          </div>
          
          <!--texto-->
          <div class="mb-3 text-start password-wrapper">
            <label class="form-label">Contraseña</label>
            
            <!--campo de texto-->
            <div class="position-relative">
              <input type="password" class="form-control pe-5" id="password-login" required
                oninvalid="this.setCustomValidity('Ingresá tu contraseña')"
                oninput="this.setCustomValidity('')">

              <i class="bi bi-eye password-toggle toggle-password"
                data-target="password-login"></i>
            </div>
          </div>
                    
          <!--link a registroo-->
          <p class="mt-3">
            ¿No tenés una cuenta? <a href="/register">Registrate acá</a>
          </p>
          <!--iniciar sesion (por ahora sin funcionalidad)-->
          <div 
            class="d-grid"> <button type="submit" class="btn btn-inicio-sesion">Iniciar sesión</button>
          </div>
          <!--boton de continuacion como invitado-->
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