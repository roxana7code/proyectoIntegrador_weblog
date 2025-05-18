<?php 
include("connection.php");
$con = connection();

$publicacion=$_GET['publicacion'];

$sql = "SELECT * FROM publicaciones WHERE publicacion='$publicacion'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Actualizar publicacion</title>
</head>
<body>
    <div class="container">
        <button onclick="window.location.href='indexCrud.php'" class="regresar-btn">Regresar</button>
        </div>
    <div class="formulario">
    <form action="edit_publicacion.php" method="POST" enctype="multipart/form-data">

            <h1>Editar publicacion</h1>

            <input type="hidden" name="publicacion" value="<?= $row['publicacion'] ?>">
            <input type="text" name="titulo" value="<?= $row['titulo'] ?>" placeholder="Titulo de la publicacion">
            <input type="text" name="autor" value="<?= $row['autor'] ?>" placeholder="Autor de la publicacion">        
            <input type="text" name="contenido" value="<?= $row['contenido'] ?>" placeholder="Contenido de la publicacion">
            <input type="text" name="resumen" value="<?= $row['resumen'] ?>" placeholder="Resumen de la publicacion">
            <input type="file" name="imagen" accept="image/*" placeholder="Imagen de la publicacion">
            <input type="date" name="fecha" value="<?= $row['fecha'] ?>">

            <input type="submit" value="Actualizar publicacion"> 
        </form>
    </div>
</body>

</html>