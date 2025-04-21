<?php 
include("connection.php");
$con = connection();

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$contenido = $_POST['contenido'];
$resumen = $_POST['resumen'];
$fecha = $_POST['fecha'];

// Verificar si se ha subido una imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = pathinfo($imagen_nombre, PATHINFO_EXTENSION);

    // Verificar que la extensión de la imagen sea válida
    if (!in_array(strtolower($ext), $extensiones_permitidas)) {
        echo "Tipo de archivo no permitido.";
        exit;
    }

    // Renombrar la imagen para evitar conflictos de nombre
    $imagen_nombre = uniqid() . '.' . $ext;
    $ruta_destino = "../imagenWeb/" . $imagen_nombre;

    // Mover la imagen a la carpeta
    if (move_uploaded_file($imagen_temp, $ruta_destino)) {
        // Preparar y ejecutar la consulta SQL
        $stmt = $con->prepare("INSERT INTO publicaciones (titulo, autor, contenido, resumen, imagen, fecha) 
                            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $titulo, $autor, $contenido, $resumen, $imagen_nombre, $fecha);
        $query = $stmt->execute();

        if ($query) {
            header("Location: index.php");
        } else {
            echo "Error al guardar la publicación en la base de datos.";
        }
    } else {
        echo "Error al mover la imagen.";
    }
} else {
    echo "No se ha subido una imagen.";
}
?>
