<?php
session_start();
include("conexion.php");
$conexion = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_comentario = intval($_POST['id_comentario']);
    $id_usuario = $_SESSION['id_usuario'];

    // Verificar que el comentario le pertenece al usuario
    $verificar = mysqli_query($conexion, "SELECT * FROM comentarios WHERE id = $id_comentario AND id_usuario = $id_usuario");
    if (mysqli_num_rows($verificar) === 1) {
        mysqli_query($conexion, "DELETE FROM comentarios WHERE id = $id_comentario");
    }
}

header("Location: post-tips.php"); // Redirige de nuevo a la página del post
exit;
?>
