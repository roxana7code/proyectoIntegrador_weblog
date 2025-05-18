<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
$conexion = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Compatibilidad con versiones antiguas de PHP (< 7.0)
    $nombre     = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $usuario    = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $email      = isset($_POST['email']) ? trim($_POST['email']) : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';
    $confirmar  = isset($_POST['confirmar_contraseña']) ? $_POST['confirmar_contraseña'] : '';
    $id_cargo   = 2;

    // Validación: campos vacíos
    if (empty($nombre) || empty($usuario) || empty($email) || empty($contraseña) || empty($confirmar)) {
        $_SESSION['mensaje_error'] = "❌ Todos los campos son obligatorios.";
        header("Location: registro.php");
        exit;
    }

    // Validación: longitud de campos
    if (strlen($usuario) < 4 || strlen($usuario) > 20) {
        $_SESSION['mensaje_error'] = "❌ El nombre de usuario debe tener entre 4 y 20 caracteres.";
        header("Location: registro.php");
        exit;
    }

    if (strlen($nombre) > 50) {
        $_SESSION['mensaje_error'] = "❌ El nombre es demasiado largo (máximo 50 caracteres).";
        header("Location: registro.php");
        exit;
    }

    // Validación: formato de correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensaje_error'] = "❌ Formato de correo no válido.";
        header("Location: registro.php");
        exit;
    }

    // Validación: contraseña segura
    if (strlen($contraseña) < 6) {
        $_SESSION['mensaje_error'] = "❌ La contraseña debe tener al menos 6 caracteres.";
        header("Location: registro.php");
        exit;
    }

    // Validación: contraseñas no coinciden
    if ($contraseña !== $confirmar) {
        $_SESSION['mensaje_error'] = "❌ Las contraseñas no coinciden.";
        header("Location: registro.php");
        exit;
    }

    // Validación: usuario ya existe
    $verificarUsuario = mysqli_query($conexion, "SELECT id FROM usuarios WHERE usuario = '" . mysqli_real_escape_string($conexion, $usuario) . "'");
    if (mysqli_num_rows($verificarUsuario) > 0) {
        $_SESSION['mensaje_error'] = "❌ El nombre de usuario ya está registrado.";
        header("Location: registro.php");
        exit;
    }

    // Validación: correo ya existe
    $verificarEmail = mysqli_query($conexion, "SELECT id FROM usuarios WHERE email = '" . mysqli_real_escape_string($conexion, $email) . "'");
    if (mysqli_num_rows($verificarEmail) > 0) {
        $_SESSION['mensaje_error'] = "❌ El correo ya está registrado.";
        header("Location: registro.php");
        exit;
    }

    // Escapar y preparar datos
    $nombreSan     = mysqli_real_escape_string($conexion, htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'));
    $usuarioSan    = mysqli_real_escape_string($conexion, htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8'));
    $emailSan      = mysqli_real_escape_string($conexion, htmlspecialchars($email, ENT_QUOTES, 'UTF-8'));
    $contraseñaHash = mysqli_real_escape_string($conexion, password_hash($contraseña, PASSWORD_DEFAULT));

    // Insertar en la base de datos
    $sql = "INSERT INTO usuarios (nombre, usuario, email, contraseña, id_cargo)
            VALUES ('$nombreSan', '$usuarioSan', '$emailSan', '$contraseñaHash', $id_cargo)";

    if (mysqli_query($conexion, $sql)) {
        $_SESSION['registro_exitoso'] = "✅ Usuario registrado correctamente. ¡Bienvenido!";
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
