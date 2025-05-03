<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "blog_database");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Actualizar la contraseña para el usuario 'administrador100'
$usuario = 'administrador100';  // Cambia al usuario que deseas actualizar
$nueva_contraseña = 'administrador101';  // La nueva contraseña en texto plano
$contraseña_hash = password_hash($nueva_contraseña, PASSWORD_DEFAULT);  // Hashea la contraseña

// Consulta para actualizar la contraseña
$consulta = "UPDATE usuarios SET contraseña = '$contraseña_hash' WHERE usuario = '$usuario'";

if (mysqli_query($conexion, $consulta)) {
    echo "Contraseña actualizada correctamente.";
} else {
    echo "Error al actualizar la contraseña: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
