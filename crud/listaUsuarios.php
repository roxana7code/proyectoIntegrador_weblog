<?php
include("connection.php");
$con = connection();

$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

session_start();
error_reporting(0);
$varsession = $_SESSION['usuario'];
if($varsession == null || $varsession == ''){
    header("location:crud/indexCrud.php");
    die();
}

// Manejar cambio de idioma
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    header("Location: ".$_SERVER['PHP_SELF']); // Recargar la página
    exit();
}

// Establecer idioma por defecto (español)
if(isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $lang = 'es';
}?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang == 'es' ? 'Publicaciones CRUD' : 'Posts CRUD' ?></title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Estilos para el botón de idioma -->
    <style>
            /* Estilos para el menú en español */
    body[lang="es"] .menu-contenido {
        margin-right: auto; /* Empuja el menú a la izquierda */
        margin-left: 20px;  /* Espacio después del logo */
    }

    /* Estilos para el menú en inglés (opcional) */
    body[lang="en"] .menu-contenido {
        margin-right: 0;
    }

    /* Ajuste general del header */
    .contenido-heder {
        display: flex;
        align-items: center;
        padding: 0 5%;
        gap: 20px;
    }

    /* Logo fijo a la izquierda */
    .logo-ods {
        flex-shrink: 0;
    }

    /* Título centrado */
    .contenido-heder h1 {
        flex-grow: 1;
        text-align: center;
        margin: 0;
    }

    .file-input-container {
    margin: 15px 0;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.file-input-label {
    padding: 12px 20px;
    background: #27ae60;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
    transition: all 0.3s ease;
    font-size: 16px;
    display: inline-block;
    width: fit-content;
}

.file-input-label:hover {
    background: #2ecc71;
    box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
}

.file-name {
    font-size: 14px;
    color: #555;
    font-style: italic;
    padding-left: 5px;
}
        .language-toggle {
            position: fixed;
            top: 15px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid #874d4d;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
            z-index: 9999;
            background-color: white;
            animation: slideInRight 0.6s ease-out;
        }

        .language-toggle:hover {
            transform: scale(1.1);
        }

        .language-toggle.idioma-activo {
            border-color: #27ae60;
            box-shadow: 0 0 12px #2ecc71;
            transform: scale(1.15);
        }

        .language-toggle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="contenido-heder">
            <div class="menu-tips">
                <div class="logo-ods"> 
                    <img src="../imagenWeb/img9.png" alt="">
                </div>
                <h1><a href="/crud/listaUsuarios.php"><?= $lang == 'es' ? 'Panel del <b>administrador</b>' : 'Admin <b>panel</b>' ?></a></h1>
                <div class="menu-contenido">
                    <nav>
                        <ul>
                            <li><a href="/crud/listaUsuarios.php"><i class="fas fa-home"></i> <span class="nav-inicio"><?= $lang == 'es' ? 'Inicio' : 'Home' ?></span></a></li>
                    </li>
                    <li>
                        <a href="/Crud/indexCrud.php">
                            <i class="fas fa-newspaper"></i>
                            <span><?= $lang == 'es' ? 'Publicaciones' : 'Posts' ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/indexUsuario.php">
                            <i class="fas fa-eye"></i>
                            <span><?= $lang == 'es' ? 'Vista previa' : 'Preview' ?></span>
                        </a>
                    </li>
                            <li><a href="/crud/cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> <span class="nav-cerrar"><?= $lang == 'es' ? 'Cerrar sesión' : 'Log out' ?></span></a></li>
                        </ul>
                    </nav>
                    <!-- Botón de idioma flotante en la parte superior derecha -->
                    <div class="language-toggle" onclick="toggleLanguage()">
                        <img id="flag-icon" src="/IMG/<?= $lang == 'es' ? 'esp.png' : 'eng.png' ?>" alt="Idioma" />
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="popup-bienvenida" class="popup-bienvenida">
        <p class="popup-texto"><?= $lang == 'es' ? 'Bienvenido al panel del administrador' : 'Welcome to the admin panel' ?></p>
    </div>


    <div class="publicaciones-table">
        <h2 class="tabla-titulo"><?= $lang == 'es' ? 'Lista de usuarios' : 'Posts list' ?></h2>
        <table>
            <thead>
            <tr>
    <th><?= $lang == 'es' ? 'ID' : 'ID' ?></th>
    <th><?= $lang == 'es' ? 'Nombre' : 'Name' ?></th>
    <th><?= $lang == 'es' ? 'Usuario' : 'Username' ?></th>
    <th><?= $lang == 'es' ? 'Correo' : 'Email' ?></th>
    <th><?= $lang == 'es' ? 'Contraseña' : 'Password' ?></th>
    <th><?= $lang == 'es' ? 'Cargo' : 'Role' ?></th>
    <th></th>
    <th></th>
    <th></th>
</tr>

            </thead>
<tbody>
    <?php while($row = mysqli_fetch_array($query)): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nombre']) ?></td>
        <td><?= htmlspecialchars($row['usuario']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['contraseña']) ?></td>
        <td><?= $row['id_cargo'] == 1 ? ($lang == 'es' ? 'Administrador' : 'Admin') : ($lang == 'es' ? 'Usuario' : 'User') ?></td>
        <td>
<td>
    <a href="eliminarUsuario.php?id=<?= $row['id'] ?>" onclick="return confirm('<?= $lang == 'es' ? '¿Estás seguro de eliminar este usuario?' : 'Are you sure you want to delete this user?' ?>')" class="eliminar-btn">
        <?= $lang == 'es' ? 'Eliminar' : 'Delete' ?>
    </a>
</td>

    </tr>
    <?php endwhile; ?>
</tbody>
        </table>
    </div>

    <div class="container-footer">
        <footer>
            <div class="logo-footer">
                <img src="../imagenWeb/img9.png" alt="">
            </div>
            <div class="redes-footer">
                <a href="https://www.facebook.com/share/193M2XwD2p/?mibextid=wwXIfr" target="_blank"><i class="fa-brands fa-facebook icon-redes-footer"></i></a>
                <a href="https://www.instagram.com/salud_optimaa?igsh=MXJuNXlsZGdjNGpvaQ%3D%3D&utm_source=qr" target="_blank"><i class="fa-brands fa-instagram icon-redes-footer"></i></a>
                <a href="https://x.com/VALERIACUE96463"><i class="fab fa-twitter icon-redes-footer"></i></a>
            </div>
            <hr>
            <h4>@ 2025 <?= $lang == 'es' ? 'salud y bienestar - Todos los derechos reservados' : 'health and wellness - All rights reserved' ?></h4>
        </footer>
    </div>

    <script>
        // Función para cambiar el idioma
        function toggleLanguage() {
            const currentLang = document.documentElement.lang;
            const newLang = currentLang === 'es' ? 'en' : 'es';
            
            // Redirigir a la misma página con el nuevo idioma
            window.location.href = `?lang=${newLang}`;
        }

        // Mostrar u ocultar formulario Crear publicación
        document.getElementById('toggleFormButton').addEventListener('click', function() {
            const formContainer = document.getElementById('formContainer');
            if (formContainer.style.display === 'none' || formContainer.style.display === '') {
                formContainer.style.display = 'block';
            } else {
                formContainer.style.display = 'none';
            }
        });

        // Popup bienvenida animado
        window.onload = function() {
            const popup = document.getElementById("popup-bienvenida");
            popup.style.display = "block";
            setTimeout(() => popup.style.display = "none", 2000);
        };

        // Mostrar nombre del archivo seleccionado
document.getElementById('imagen').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 
                   ('<?= $lang == 'es' ? 'Ningún archivo seleccionado' : 'No file selected' ?>');
    document.getElementById('file-name').textContent = fileName;
});
    </script>
    </div>
</body>
</html>