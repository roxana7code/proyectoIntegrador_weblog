<?php
session_start();
include 'conexion.php';
$con = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $publicacion_id = $_POST['publicacion_id'];
    $usuario_id = $_POST['usuario_id'];

    // Primero, verificar si el usuario ya dio like
    $check_like_sql = "SELECT * FROM likes WHERE publicacion_id = ? AND usuario_id = ?";
    $stmt = $con->prepare($check_like_sql);
    $stmt->bind_param("ii", $publicacion_id, $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ya dio like, entonces lo quitamos (unlike)
        $delete_sql = "DELETE FROM likes WHERE publicacion_id = ? AND usuario_id = ?";
        $stmt_del = $con->prepare($delete_sql);
        $stmt_del->bind_param("ii", $publicacion_id, $usuario_id);
        $stmt_del->execute();
        $stmt_del->close();

        $status = 'unliked';
    } else {
        // No ha dado like, lo insertamos
        $insert_sql = "INSERT INTO likes (publicacion_id, usuario_id) VALUES (?, ?)";
        $stmt_ins = $con->prepare($insert_sql);
        $stmt_ins->bind_param("ii", $publicacion_id, $usuario_id);
        $stmt_ins->execute();
        $stmt_ins->close();

        $status = 'liked';
    }

    // Contar total likes actualizados
    $count_sql = "SELECT COUNT(*) as total FROM likes WHERE publicacion_id = ?";
    $stmt_count = $con->prepare($count_sql);
    $stmt_count->bind_param("i", $publicacion_id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $total_likes = $result_count->fetch_assoc()['total'];

    $stmt_count->close();
    $stmt->close();
    $con->close();

    // Respuesta JSON para el JS
    echo json_encode([
        'status' => $status,
        'total_likes' => $total_likes
    ]);
    exit;
}
?>
