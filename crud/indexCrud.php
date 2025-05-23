<?php
include("connection.php");
$con = connection();

$sql = "SELECT * FROM publicaciones";
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
                <h1><a href="/crud/indexCrud.php"><?= $lang == 'es' ? 'Panel del <b>administrador</b>' : 'Admin <b>panel</b>' ?></a></h1>
                <div class="menu-contenido">
                    <nav>
                        <ul>
                            <li><a href="/crud/indexCrud.php"><i class="fas fa-home"></i> <span class="nav-inicio"><?= $lang == 'es' ? 'Inicio' : 'Home' ?></span></a></li>
                                    <li><a href="/crud/listaUsuarios.php"><i class="fas fa-users"></i> <span class="nav-usuarios"><?= $lang == 'es' ? 'Usuarios' : 'Users' ?></span></a></li>
                            <li><a href="/indexUsuario.php"><i class="fas fa-sign-in-alt"></i> <span class="nav-vista"><?= $lang == 'es' ? 'Vista previa' : 'Preview' ?></span></a></li>
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

    <div class="container">
        <button id="toggleFormButton" class="crear-publicacion-btn"><?= $lang == 'es' ? 'Crear publicación' : 'Create post' ?></button>
        <div id="formContainer" class="formulario oculto">
            <h1 class="form-titulo"><?= $lang == 'es' ? 'Crear publicación' : 'Create post' ?></h1>
            <form action="insert_publicacion.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="titulo" placeholder="<?= $lang == 'es' ? 'Título de la publicación' : 'Post title' ?>" required>
    <input type="text" name="autor" placeholder="<?= $lang == 'es' ? 'Autor de la publicación' : 'Author' ?>" required>        
    <input type="text" name="contenido" placeholder="<?= $lang == 'es' ? 'Contenido de la publicación' : 'Content' ?>" required>
    <input type="text" name="resumen" placeholder="<?= $lang == 'es' ? 'Resumen de la publicación' : 'Summary' ?>" required>
    
    <div class="file-input-container">
        <label for="imagen" class="file-input-label">
            <?= $lang == 'es' ? 'Seleccionar imagen' : 'Select image' ?>
            <input type="file" name="imagen" id="imagen" accept="image/*" required style="display: none;">
        </label>
        <span id="file-name" class="file-name"><?= $lang == 'es' ? 'Ningún archivo seleccionado' : 'No file selected' ?></span>
    </div>
    
    <input type="date" name="fecha" required>
    <input type="submit" value="<?= $lang == 'es' ? 'Agregar publicación' : 'Add post' ?>"> 
</form>
        </div>
    </div>

    <div class="publicaciones-table">
        <h2 class="tabla-titulo"><?= $lang == 'es' ? 'Lista de publicaciones' : 'Posts list' ?></h2>
        <table>
            <thead>
                <tr>
                    <th><?= $lang == 'es' ? 'Publicación' : 'Post' ?></th>
                    <th><?= $lang == 'es' ? 'Título' : 'Title' ?></th>
                    <th><?= $lang == 'es' ? 'Autor' : 'Author' ?></th>
                    <th><?= $lang == 'es' ? 'Contenido' : 'Content' ?></th>
                    <th><?= $lang == 'es' ? 'Resumen' : 'Summary' ?></th>
                    <th><?= $lang == 'es' ? 'Imagen' : 'Image' ?></th>
                    <th><?= $lang == 'es' ? 'Fecha' : 'Date' ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <td><?= $row['publicacion'] ?></td>
                    <td><?= $row['titulo'] ?></td>
                    <td><?= $row['autor'] ?></td>
                    <td><?= $row['contenido'] ?></td>
                    <td><?= $row['resumen'] ?></td>
                    <td><?= $row['imagen'] ?></td>
                    <td><?= $row['fecha'] ?></td>
                    <td>
                        <button class="ver-btn" 
                            data-titulo="<?= htmlspecialchars($row['titulo']) ?>"
                            data-autor="<?= htmlspecialchars($row['autor']) ?>"
                            data-contenido="<?= htmlspecialchars($row['contenido']) ?>"
                            data-resumen="<?= htmlspecialchars($row['resumen']) ?>"
                            data-imagen="<?= htmlspecialchars($row['imagen']) ?>"
                            data-fecha="<?= htmlspecialchars($row['fecha']) ?>"
                            data-idioma="<?= $lang ?>"
                        >
                            <?= $lang == 'es' ? 'Ver' : 'View' ?>
                        </button>
                    </td>
                    <td><a href="update.php?publicacion=<?= $row['publicacion']?>" class="publicaciones-table--edit"><?= $lang == 'es' ? 'Editar' : 'Edit' ?></a></td>
                    <td><a href="delete_publicacion.php?publicacion=<?= $row['publicacion']?>" class="publicaciones-table--delete"><?= $lang == 'es' ? 'Eliminar' : 'Delete' ?></a></td>
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

        // Modal para mostrar detalles de publicación
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("postModal");
            const modalContent = document.getElementById("modal-content");
            const closeBtn = document.getElementById("modalClose");

            document.querySelectorAll(".ver-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const titulo = this.dataset.titulo;
                    const autor = this.dataset.autor;
                    const contenido = this.dataset.contenido;
                    const resumen = this.dataset.resumen;
                    const imagen = this.dataset.imagen;
                    const fecha = this.dataset.fecha;
                    const idioma = this.dataset.idioma || '<?= $lang ?>';

                    const translations = {
                        es: {
                            'Autor': 'Autor',
                            'Contenido': 'Contenido',
                            'Resumen': 'Resumen',
                            'Fecha': 'Fecha'
                        },
                        en: {
                            'Autor': 'Author',
                            'Contenido': 'Content',
                            'Resumen': 'Summary',
                            'Fecha': 'Date'
                        }
                    };

                    modalContent.innerHTML = `
                        <h2>${titulo}</h2>
                        ${imagen ? `<img src="../imagenWeb/${imagen}" alt="Imagen de la publicación" style="max-width:100%;">` : ""}
                        <p><strong>${translations[idioma]['Autor']}:</strong> ${autor}</p>
                        <p><strong>${translations[idioma]['Contenido']}:</strong> ${contenido}</p>
                        <p><strong>${translations[idioma]['Resumen']}:</strong> ${resumen}</p>
                        <p><strong>${translations[idioma]['Fecha']}:</strong> ${fecha}</p>
                    `;

                    modal.style.display = "block";
                });
            });

            closeBtn.addEventListener("click", () => modal.style.display = "none");
            window.addEventListener("click", e => { if (e.target == modal) modal.style.display = "none"; });
        });

        // Mostrar nombre del archivo seleccionado
document.getElementById('imagen').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 
                   ('<?= $lang == 'es' ? 'Ningún archivo seleccionado' : 'No file selected' ?>');
    document.getElementById('file-name').textContent = fileName;
});
    </script>

    <!-- Modal para mostrar la publicación -->
    <div id="postModal" class="modal" style="display:none; position: fixed; z-index: 10000; left: 0; top: 0; width: 100%; height: 100%; overflow:auto; background-color: rgba(0,0,0,0.5);">
        <div style="background:#fff; margin: 10% auto; padding: 20px; border-radius: 5px; width: 80%; max-width: 600px; position: relative;">
            <span id="modalClose" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size: 28px;">&times;</span>
            <div id="modal-content"></div>
        </div>
    </div>
</body>
</html>