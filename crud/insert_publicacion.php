<?php 
include("connection.php");
session_start();

// Validar sesión (opcional según contexto)
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: /crud/indexCrud.php");
    exit();
}

$con = connection();
if (!$con) {
    die("Error de conexión a la base de datos.");
}

// Sanitizar entradas (evitar inyección XSS y SQL Injection)
$titulo = trim($_POST['titulo'] ?? '');
$autor = trim($_POST['autor'] ?? '');
$contenido = trim($_POST['contenido'] ?? '');
$resumen = trim($_POST['resumen'] ?? '');
$fecha = trim($_POST['fecha'] ?? '');

// Validar campos obligatorios
if (empty($titulo) || empty($autor) || empty($contenido) || empty($resumen) || empty($fecha)) {
    die("Por favor, complete todos los campos obligatorios.");
}

// Validar formato de fecha (YYYY-MM-DD)
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
    die("Formato de fecha inválido.");
}

// Validar que la fecha no sea anterior a la fecha actual
$fecha_actual = date('Y-m-d');
if ($fecha < $fecha_actual) {
    die("La fecha no puede ser anterior a hoy.");
}

// Validar y procesar imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($imagen_nombre, PATHINFO_EXTENSION));

    if (!in_array($ext, $extensiones_permitidas)) {
        die("Tipo de archivo no permitido. Solo se permiten imágenes JPG, JPEG, PNG y GIF.");
    }

    // Limitar tamaño máximo (por ejemplo 2MB)
    if ($_FILES['imagen']['size'] > 2 * 1024 * 1024) {
        die("El archivo es demasiado grande. El tamaño máximo permitido es 2MB.");
    }

    // Renombrar la imagen para evitar conflictos de nombre
    $imagen_nombre = uniqid('img_') . '.' . $ext;
    $ruta_destino = "../imagenWeb/" . $imagen_nombre;

    if (!move_uploaded_file($imagen_temp, $ruta_destino)) {
        die("Error al mover la imagen.");
    }
} else {
    die("No se ha subido una imagen o hubo un error en la subida.");
}

// Insertar en la base de datos con sentencia preparada
$stmt = $con->prepare("INSERT INTO publicaciones (titulo, autor, contenido, resumen, imagen, fecha) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $con->error);
}
$stmt->bind_param("ssssss", $titulo, $autor, $contenido, $resumen, $imagen_nombre, $fecha);

if ($stmt->execute()) {
    header("Location: /crud/indexCrud.php");
    exit();
} else {
    echo "Error al guardar la publicación en la base de datos: " . $stmt->error;
}
?>
