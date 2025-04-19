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
                    <img src="imagenWeb/img9.png" alt="">
                </div>
                <h1><a href="index.html">Panel del <b>admin</b></a></h1>
                <div class="menu-contenido">
                    <nav>
                        <ul>
                        <li><a href="index.html"><i class="fas fa-home"></i> Inicio</a></li>
                        <li><a href="#"><i class="fas fa-sign-in-alt"></i> Cerrar sesion</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Publicaciones CRUD</title>
</head>

<body>
    <div class="formulario">
        <form action="insert_publicacion.php" method="POST">
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
                    <img src="imagenWeb/img9.png" alt="">
                </div>

                <div class="redes-footer">
                    <a href="https://www.facebook.com/share/193M2XwD2p/?mibextid=wwXIfr" target="_blank"><i class="fa-brands fa-facebook icon-redes-footer"></i></a>
                    <a href="https://www.instagram.com/salud_optimaa?igsh=MXJuNXlsZGdjNGpvaQ%3D%3D&utm_source=qr" target="_blank"><i class="fa-brands fa-instagram icon-redes-footer"></i></a>
                    <a href="#"><i class="fab fa-twitter icon-redes-footer"></i></a>
                </div>

                <hr>
                <h4>@ 2025 salud y bienestar - Todos los derechos reservados</h4>
            </footer>
        </div>
</body>
</html>