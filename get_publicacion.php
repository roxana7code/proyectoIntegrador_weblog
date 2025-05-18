<?php
include 'conexion.php'; // Incluye tu archivo de conexión
$con = connection(); // Llama a la función de conexión

$id = $_GET['id']; // Obtiene el ID de la publicación

$sql = "SELECT * FROM publicaciones WHERE publicacion = '$id'";
$query = mysqli_query($con, $sql);

if ($query) {
    $post = mysqli_fetch_assoc($query);
    echo json_encode($post); // Devuelve los datos como JSON
} else {
    echo json_encode(['error' => 'No se encontró la publicación.']);
}

mysqli_close($con); // Cierra la conexión
?>
