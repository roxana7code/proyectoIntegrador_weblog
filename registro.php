<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/cabecera.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .password-container {
            position: relative;
        }

        .password-container input {
            padding-right: 30px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .language-toggle {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
<?php session_start(); ?>
<?php if (isset($_SESSION['mensaje_error'])): ?>
    <div style="color: red; background: #ffe5e5; padding: 10px 15px; text-align: center; font-weight: bold; margin: 20px auto; width: 80%; border-radius: 5px;">
        <?= $_SESSION['mensaje_error']; unset($_SESSION['mensaje_error']); ?>
    </div>
<?php endif; ?>

<!-- Botón de idioma -->
<div class="language-toggle" onclick="toggleLanguage()">
  <img id="flag-icon" src="img/esp.png" alt="Idioma" style="width: 40px;">
</div>

<form action="registrar.php" method="post">
    <h1 data-es="Registro de Usuario" data-en="User Registration">Registro de Usuario</h1>
    <a href="/inicioSesion.php" class="btn-regresar" data-es="← Regresar al Login" data-en="← Back to Login">← Regresar al Login</a>

    <p>
      <span data-es="Nombre completo" data-en="Full Name">Nombre completo</span>
      <input type="text" 
             placeholder="Ingresa tu nombre" 
             data-es-placeholder="Ingresa tu nombre" 
             data-en-placeholder="Enter your full name" 
             name="nombre" required>
    </p>

    <p>
      <span data-es="Nombre de Usuario" data-en="Username">Nombre de Usuario</span>
      <input type="text" 
             placeholder="Crea tu nombre de usuario" 
             data-es-placeholder="Crea tu nombre de usuario" 
             data-en-placeholder="Create your username" 
             name="usuario" required>
    </p>

    <p>
      <span data-es="Correo Electrónico" data-en="Email">Correo Electrónico</span>
      <input type="email" 
             placeholder="Ingresa tu correo" 
             data-es-placeholder="Ingresa tu correo" 
             data-en-placeholder="Enter your email" 
             name="email" required>
    </p>

    <p>
      <span data-es="Contraseña" data-en="Password">Contraseña</span>
      <div class="password-container">
        <input type="password" id="contraseña" 
               placeholder="Crea una contraseña" 
               data-es-placeholder="Crea una contraseña" 
               data-en-placeholder="Create a password" 
               name="contraseña" required>
        <i class="fas fa-eye toggle-password" onclick="togglePassword('contraseña', this)"></i>
      </div>
    </p>

    <p>
      <span data-es="Confirmar Contraseña" data-en="Confirm Password">Confirmar Contraseña</span>
      <div class="password-container">
        <input type="password" id="confirmar_contraseña" 
               placeholder="Repite la contraseña" 
               data-es-placeholder="Repite la contraseña" 
               data-en-placeholder="Repeat the password" 
               name="confirmar_contraseña" required>
        <i class="fas fa-eye toggle-password" onclick="togglePassword('confirmar_contraseña', this)"></i>
      </div>
    </p>

    <input type="submit" 
           value="Registrarse" 
           data-es-value="Registrarse" 
           data-en-value="Register">

    <p style="text-align: center; margin-top: 20px;">
      <span data-es="¿Ya tienes una cuenta?" data-en="Already have an account?">¿Ya tienes una cuenta?</span>
      <a href="/inicioSesion.php" class="btn-registro" data-es="Inicia Sesión" data-en="Log In">Inicia Sesión</a>
    </p>
</form>

<script>
let currentLang = 'es';

function toggleLanguage() {
  currentLang = currentLang === 'es' ? 'en' : 'es';
  document.getElementById('flag-icon').src = currentLang === 'es' ? 'img/esp.png' : 'img/eng.png';
  translateContent();
}

function translateContent() {
  // Cambia textos
  document.querySelectorAll('[data-es]').forEach(el => {
    if (el.tagName === 'INPUT') {
      if (el.type === 'submit' && el.hasAttribute(`data-${currentLang}-value`)) {
        el.value = el.getAttribute(`data-${currentLang}-value`);
      }
    } else {
      el.textContent = el.getAttribute(`data-${currentLang}`);
    }
  });

  // Cambia placeholders
  document.querySelectorAll('[data-es-placeholder]').forEach(el => {
    el.placeholder = el.getAttribute(`data-${currentLang}-placeholder`);
  });
}

function togglePassword(id, icon) {
  const input = document.getElementById(id);
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}

translateContent();
</script>
</body>
</html>
