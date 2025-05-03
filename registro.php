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
    </style>
</head>

<body>
<?php session_start(); ?>
<?php if (isset($_SESSION['mensaje_error'])): ?>
    <div style="color: red; background: #ffe5e5; padding: 10px 15px; text-align: center; font-weight: bold; margin: 20px auto; width: 80%; border-radius: 5px;">
        <?= $_SESSION['mensaje_error']; unset($_SESSION['mensaje_error']); ?>
    </div>
<?php endif; ?>

<form action="registrar.php" method="post">
    <h1>Registro de Usuario</h1>
    <a href="/index.php" class="btn-regresar">← Regresar al Login</a>

    <p>Nombre completo <input type="text" placeholder="Ingresa tu nombre" name="nombre" required></p>
    <p>Nombre de Usuario <input type="text" placeholder="Crea tu nombre de usuario" name="usuario" required></p>
    <p>Correo Electrónico <input type="email" placeholder="Ingresa tu correo" name="email" required></p>

    <p>
        Contraseña
        <div class="password-container">
            <input type="password" id="contraseña" placeholder="Crea una contraseña" name="contraseña" required>
            <i class="fas fa-eye toggle-password" onclick="togglePassword('contraseña', this)"></i>
        </div>
    </p>

    <p>
        Confirmar Contraseña
        <div class="password-container">
            <input type="password" id="confirmar_contraseña" placeholder="Repite la contraseña" name="confirmar_contraseña" required>
            <i class="fas fa-eye toggle-password" onclick="togglePassword('confirmar_contraseña', this)"></i>
        </div>
    </p>

    <input type="submit" value="Registrarse">

    <p style="text-align: center; margin-top: 20px;">
        ¿Ya tienes una cuenta?
        <a href="index.php" class="btn-registro">Inicia Sesión</a>
    </p>
</form>

<script>
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
</script>
</body>
</html>
