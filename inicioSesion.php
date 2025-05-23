<?php
session_start();
$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es');
$_SESSION['lang'] = $lang;
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang == 'es' ? 'Login' : 'Login'; ?></title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/cabecera.css">
    <style>
        .language-toggle {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Botón de idioma -->
    <div class="language-toggle" onclick="toggleLanguage()">
        <img id="flag-icon" src="img/<?php echo $lang == 'es' ? 'esp.png' : 'eng.png'; ?>" alt="Idioma">
    </div>

    <form action="validar.php?lang=<?php echo $lang; ?>" method="post">
        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
        
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'usuario') {
                echo '<p style="color:red; text-align:center;">'.($lang == 'es' ? 'ERROR EN LA AUTENTICACIÓN: Usuario no encontrado.' : 'AUTHENTICATION ERROR: User not found.').'</p>';
            } elseif ($_GET['error'] == 'contraseña') {
                echo '<p style="color:red; text-align:center;">'.($lang == 'es' ? 'ERROR EN LA AUTENTICACIÓN: Contraseña incorrecta.' : 'AUTHENTICATION ERROR: Incorrect password.').'</p>';
            }
        }
        ?>

        <h1><?php echo $lang == 'es' ? 'Sistema de Login' : 'Login System'; ?></h1>
        <a href="visitante.php?lang=<?php echo $lang; ?>" class="btn-regresar"><?php echo $lang == 'es' ? '← Regresar' : '← Back'; ?></a>

        <p>
            <span><?php echo $lang == 'es' ? 'Usuario' : 'Username'; ?></span>
            <input type="text" 
                   placeholder="<?php echo $lang == 'es' ? 'Ingrese su nombre' : 'Enter your username'; ?>" 
                   name="usuario" required>
        </p>

        <p>
            <span><?php echo $lang == 'es' ? 'Contraseña' : 'Password'; ?></span><br>
            <input type="password" id="contraseña" 
                   placeholder="<?php echo $lang == 'es' ? 'Ingrese su contraseña' : 'Enter your password'; ?>" 
                   name="contraseña" required>
            <label for="ver_contraseña"><?php echo $lang == 'es' ? 'Mostrar contraseña' : 'Show password'; ?></label>
            <input type="checkbox" id="ver_contraseña">
        </p>

        <input type="submit" value="<?php echo $lang == 'es' ? 'Ingresar' : 'Login'; ?>">

        <p style="text-align: center; margin-top: 20px;">
            <span><?php echo $lang == 'es' ? '¿No tienes una cuenta?' : 'Don\'t have an account?'; ?></span>
            <a href="registro.php?lang=<?php echo $lang; ?>" class="btn-registro"><?php echo $lang == 'es' ? 'Regístrate' : 'Register'; ?></a>
        </p>
    </form>

    <script>
        // Mostrar/ocultar contraseña
        document.getElementById('ver_contraseña').addEventListener('change', function () {
            const passwordField = document.getElementById('contraseña');
            passwordField.type = this.checked ? 'text' : 'password';
        });

        // Traducción dinámica
        let currentLang = '<?php echo $lang; ?>';

        function toggleLanguage() {
            currentLang = currentLang === 'es' ? 'en' : 'es';
            document.getElementById('flag-icon').src = currentLang === 'es' ? 'img/esp.png' : 'img/eng.png';
            localStorage.setItem('language', currentLang);
            
            // Redirigir para aplicar cambios en PHP
            window.location.href = window.location.pathname + '?lang=' + currentLang;
        }

        // Cargar idioma guardado
        window.addEventListener('DOMContentLoaded', function() {
            var savedLang = localStorage.getItem('language') || '<?php echo $lang; ?>';
            if(savedLang !== '<?php echo $lang; ?>') {
                window.location.href = window.location.pathname + '?lang=' + savedLang;
            }
        });
    </script>
</body>
</html>