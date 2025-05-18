<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
$conexion = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();

        if (password_verify($contraseña, $fila['contraseña'])) {
            // Guardar el id del usuario en sesión
            $_SESSION['usuario_id'] = $fila['id'];  // <-- Aquí está la clave
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id_cargo'] = $fila['id_cargo'];
            $_SESSION['tipo'] = ($fila['id_cargo'] == 1) ? 'admin' : 'usuario';

            if ($fila['id_cargo'] == 1) {
                header("Location: /crud/indexCrud.php");
                exit;
            } elseif ($fila['id_cargo'] == 2) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/indexUsuario.php");
                exit;
            } else {
                header("Location: inicioSesion.php?error=cargo");
                exit;
            }
        } else {
            header("Location: inicioSesion.php?error=contraseña");
            exit;
        }
    } else {
        header("Location: /inicioSesion.php?error=usuario");
        exit;
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location: index.php?error=metodo");
    exit;
}
?>
