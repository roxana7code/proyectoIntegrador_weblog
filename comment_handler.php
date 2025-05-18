<?php
session_start();
include 'conexion.php';
$con = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $publicacion_id = $_POST['publicacion_id'] ?? '';
    $usuario_id = $_POST['usuario_id'] ?? '';
    $comentario = $_POST['comentario'] ?? '';

    if (!$publicacion_id || !$usuario_id || !$comentario) {
        http_response_code(400);
        echo 'error';
        exit;
    }

    // Insertar comentario con fecha actual
    $insert_sql = "INSERT INTO comentarios (publicacion_id, usuario_id, comentario, fecha) VALUES (?, ?, ?, NOW())";
    $stmt = $con->prepare($insert_sql);
    $stmt->bind_param("iis", $publicacion_id, $usuario_id, $comentario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'success';
    } else {
        http_response_code(500);
        echo 'error';
    }

    $stmt->close();
    $con->close();
} else {
    http_response_code(405);
    echo 'Método no permitido';
}
?>
