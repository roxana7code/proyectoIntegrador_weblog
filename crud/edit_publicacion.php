<?php

include("connection.php");
$con = connection();

$publicacion = $_POST['publicacion'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$contenido = $_POST['contenido'];
$resumen = $_POST['resumen'];

// Manejo de la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    // Se ha enviado una imagen, procesamos la carga
    $imagen = $_FILES['imagen']['name'];
    $tmp_name = $_FILES['imagen']['tmp_name'];
    $destino = "uploads/" . $imagen; // Ajusta la ruta de destino según tu estructura
    move_uploaded_file($tmp_name, $destino); // Mueve la imagen al directorio adecuado
} else {
    // No se ha enviado una nueva imagen, puedes mantener la imagen anterior
    // Si necesitas conservar la imagen anterior, deberías obtenerla de la base de datos y usarla
    // Ejemplo: $imagen = $row['imagen']; si ya tienes la imagen guardada
    $imagen = $_POST['imagen_actual']; // Si la imagen actual está disponible en el formulario
}

$fecha = $_POST['fecha'];

// Actualizar en la base de datos
$sql = "UPDATE publicaciones SET 
            titulo = '$titulo', 
            autor = '$autor', 
            contenido = '$contenido', 
            resumen = '$resumen', 
            imagen = '$imagen', 
            fecha = '$fecha' 
        WHERE publicacion = '$publicacion'";

$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: /crud/indexCrud.php");
} else {
    echo "Error al actualizar la publicación.";
}

?>
