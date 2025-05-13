<?php
session_start(); // Asegúrate de iniciar la sesión
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
$conexion = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Compatibilidad con versiones antiguas de PHP (< 7.0)
    $nombre     = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $usuario    = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $email      = isset($_POST['email']) ? $_POST['email'] : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';
    $confirmar  = isset($_POST['confirmar_contraseña']) ? $_POST['confirmar_contraseña'] : '';
    $id_cargo   = 2;

    // Validación: contraseñas no coinciden
    if ($contraseña !== $confirmar) {
        $_SESSION['mensaje_error'] = "❌ Las contraseñas no coinciden.";
        header("Location: registro.php");
        exit;
    }

    // Validación: usuario ya existe
    $verificar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='" . mysqli_real_escape_string($conexion, $usuario) . "'");
    if (mysqli_num_rows($verificar) > 0) {
        $_SESSION['mensaje_error'] = "❌ El nombre de usuario ya está registrado.";
        header("Location: registro.php");
        exit;
    }

    // Crear usuario
    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);
    $nombre     = mysqli_real_escape_string($conexion, $nombre);
    $usuario    = mysqli_real_escape_string($conexion, $usuario);
    $email      = mysqli_real_escape_string($conexion, $email);
    $contraseñaHash = mysqli_real_escape_string($conexion, $contraseñaHash);

    $sql = "INSERT INTO usuarios (nombre, usuario, email, contraseña, id_cargo)
            VALUES ('$nombre', '$usuario', '$email', '$contraseñaHash', $id_cargo)";

    if (mysqli_query($conexion, $sql)) {
        header("Location: /inicioSesion.php");
        exit;
    } else {
        $_SESSION['mensaje_error'] = "❌ Error al registrar: " . mysqli_error($conexion);
        header("Location: registro.php");
        exit;
    }
} else {
    $_SESSION['mensaje_error'] = "⚠️ Acceso no válido. Solo se permiten solicitudes POST.";
    header("Location: registro.php");
    exit;
}
?>