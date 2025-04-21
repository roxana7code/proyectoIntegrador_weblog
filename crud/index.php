<?php
include("connection.php");

$con = connection();

$sql = "SELECT * FROM publicaciones";
$query = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<header>
        <div class="contenido-heder">
            <div class="menu-tips">
                <div class="logo-ods"> 
                    <img src="../imagenWeb/img9.png" alt="">
                </div>
                <h1><a href="index.php">Panel del <b>admin</b></a></h1>
                <div class="menu-contenido">
                    <nav>
                        <ul>
                        <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
                        <li><a href="../index.html"><i class="fas fa-sign-in-alt"></i> Cerrar sesión</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div id="popup-bienvenida" class="popup-bienvenida">
    <p>Bienvenido al panel del admin</p>
</div>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Publicaciones CRUD</title>
</head>

<body>
    <div class="formulario">
    <form action="insert_publicacion.php" method="POST" enctype="multipart/form-data">

            <h1>Crear publicacion</h1>

        <input type="text" name="titulo" placeholder="Titulo de la publicacion">
        <input type="text" name="autor" placeholder="Autor de la publicacion">        
        <input type="text" name="contenido" placeholder="Contenido de la publicacion">
        <input type="text" name="resumen" placeholder="Resumen de la publicacion">
        <input type="file" name="imagen" accept="image/*" placeholder="Imagen de la publicacion">
        <input type="date" name="fecha">

        <input type="submit" value="Agregar publicacion"> 
        </form>
    </div>

    <div class="publicaciones-table">
        <h2>Lista de publicaciones</h2>
        <table>
            <thead>
                <tr>
                    <th>publicacion</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Contenido</th>
                    <th>Resumen</th>
                    <th>Imagen</th>
                    <th>Fecha</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($query)): ?>
                <tr>

                <th> <?= $row['publicacion']?> </th>
                <th> <?= $row['titulo'] ?></th>
                <th><?= $row['autor'] ?></th>
                <th><?= $row['contenido'] ?></th>
                <th><?= $row['resumen'] ?></th>
                <th><?= $row['imagen'] ?></th>
                <th><?= $row['fecha'] ?></th>
                <th>
<button class="ver-btn" 
    data-titulo="<?= htmlspecialchars($row['titulo']) ?>"
    data-autor="<?= htmlspecialchars($row['autor']) ?>"
    data-contenido="<?= htmlspecialchars($row['contenido']) ?>"
    data-resumen="<?= htmlspecialchars($row['resumen']) ?>"
    data-imagen="<?= htmlspecialchars($row['imagen']) ?>"
    data-fecha="<?= htmlspecialchars($row['fecha']) ?>"
>
    Ver
</button>
</th>

                <th><a href="update.php?publicacion=<?= $row['publicacion']?>" class="publicaciones-table--edit">Editar</a></th>
                <th><a href="delete_publicacion.php?publicacion=<?= $row['publicacion']?>" class="publicaciones-table--delete">Eliminar</a></th>
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
                <h4>@ 2025 salud y bienestar - Todos los derechos reservados</h4>
            </footer>
        </div>
        <script>
    window.onload = function() {
        const popup = document.getElementById('popup-bienvenida');
        popup.style.display = 'block';
        popup.style.animation = 'fadeIn 1s ease forwards';

        setTimeout(() => {
            popup.style.animation = 'fadeOut 1s ease forwards';
        }, 9000); // inicia salida al segundo 9

        setTimeout(() => {
            popup.style.display = 'none';
        }, 10000); // oculta al segundo 10
    };
</script>
<!-- Modal para ver publicación -->
<div id="postModal" class="modal">
<div class="modal-content">
    <span class="close" id="modalClose">&times;</span>
    <div id="modal-content">
    <!-- Aquí se mostrará la información de la publicación -->
    </div>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
const modal = document.getElementById("postModal");
const modalContent = document.getElementById("modal-content");
const closeBtn = document.getElementById("modalClose");

  // Escucha clics en todos los botones con la clase ver-btn
document.querySelectorAll(".ver-btn").forEach(button => {
    button.addEventListener("click", function () {
    const titulo = this.dataset.titulo;
    const autor = this.dataset.autor;
    const contenido = this.dataset.contenido;
    const resumen = this.dataset.resumen;
    const imagen = this.dataset.imagen;
    const fecha = this.dataset.fecha;

    modalContent.innerHTML = `
        <h2>${titulo}</h2>
        ${imagen ? `<img src="../imagenWeb/${imagen}" alt="Imagen de la publicación">` : ""}
        <p><strong>Autor:</strong> ${autor}</p>
        <p><strong>Contenido:</strong> ${contenido}</p>
        <p><strong>Resumen:</strong> ${resumen}</p>
        <p><strong>Fecha:</strong> ${fecha}</p>
    `;

    modal.style.display = "block";
    });
});

closeBtn.addEventListener("click", function () {
    modal.style.display = "none";
});

window.addEventListener("click", function (event) {
    if (event.target == modal) {
    modal.style.display = "none";
    }
});
});

document.addEventListener("DOMContentLoaded", function () {
const modal = document.getElementById("postModal");
const modalContent = document.getElementById("modal-content");
const closeBtn = document.getElementById("modalClose");

  // Escucha clics en todos los botones con la clase ver-btn
document.querySelectorAll(".ver-btn").forEach(button => {
    button.addEventListener("click", function () {
    const titulo = this.dataset.titulo;
    const autor = this.dataset.autor;
    const contenido = this.dataset.contenido;
    const resumen = this.dataset.resumen;
    const imagen = this.dataset.imagen;
    const fecha = this.dataset.fecha;

    modalContent.innerHTML = `
        <h2>${titulo}</h2>
        ${imagen ? `<img src="../imagenWeb/${imagen}" alt="Imagen de la publicación">` : ""}
        <p><strong>Autor:</strong> ${autor}</p>
        <p><strong>Contenido:</strong> ${contenido}</p>
        <p><strong>Resumen:</strong> ${resumen}</p>
        <p><strong>Fecha:</strong> ${fecha}</p>
    `;

    modal.style.display = "block";
    });
});

closeBtn.addEventListener("click", function () {
    modal.style.display = "none";
});

window.addEventListener("click", function (event) {
    if (event.target == modal) {
    modal.style.display = "none";
    }
});
});

</script>

</body>
</html>