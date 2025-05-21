<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/cabecera.css">
</head>
<body>
    <form action="validar.php" method="post">
    <?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'usuario') {
        echo '<p style="color:red; text-align:center;">ERROR EN LA AUTENTICACIÓN: Usuario no encontrado.</p>';
    } elseif ($_GET['error'] == 'contraseña') {
        echo '<p style="color:red; text-align:center;">ERROR EN LA AUTENTICACIÓN: Contraseña incorrecta.</p>';
    }
}
?>

        <h1>Sistema de Login</h1>
        <a href="visitante.php" class="btn-regresar">← Regresar</a>
        
        <p>Usuario <input type="text" placeholder="Ingrese su nombre" name="usuario" required></p>
        
        <p>Contraseña 
            <input type="password" id="contraseña" placeholder="Ingrese su contraseña" name="contraseña" required>
            <label for="ver_contraseña">Mostrar contraseña</label>
            <input type="checkbox" id="ver_contraseña">
        </p>

        <input type="submit" value="Ingresar">
        
        <p style="text-align: center; margin-top: 20px;">
            ¿No tienes una cuenta?
            <a href="registro.php" class="btn-registro">Regístrate</a>
        </p>
    </form>

    <script>
        // Función para mostrar u ocultar la contraseña
        document.getElementById('ver_contraseña').addEventListener('change', function() {
            var passwordField = document.getElementById('contraseña');
            if (this.checked) {
                passwordField.type = 'text'; // Mostrar la contraseña
            } else {
                passwordField.type = 'password'; // Ocultar la contraseña
            }
        });
    </script>
</body>
</html>
