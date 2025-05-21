<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de búsqueda</title>
    <link rel="stylesheet" href="detallepublicacion.css">  <!-- Opcional, según tus estilos -->
</head>
<body>

<?php
if (isset($_GET['q'])) {
    $busqueda = htmlspecialchars($_GET['q']);

    include('conexion.php'); 
    $conexion = connection();

    if (!$conexion) {
        die("<p>Error de conexión a la base de datos.</p>");
    }

    $busqueda = mysqli_real_escape_string($conexion, $busqueda);

    $query = "SELECT * FROM publicaciones WHERE titulo LIKE '%$busqueda%' OR contenido LIKE '%$busqueda%' LIMIT 1";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("<p>Error en la consulta: " . mysqli_error($conexion) . "</p>");
    }

    if (mysqli_num_rows($resultado) > 0) {
        // Obtener el primer resultado
        $fila = mysqli_fetch_assoc($resultado);

        // Redirigir directamente a detalle_publicacion con el id
        header("Location: detalle_publicacion.php?id=" . intval($fila['publicacion']));
        exit();
    } else {
        // Mostrar mensaje en esta misma página si no hay resultados
        echo "<p class='mensaje-error'>No se encontró ninguna publicación con \"<strong>" . htmlspecialchars($busqueda) . "</strong>\".</p>";
    }

    mysqli_close($conexion);
} else {
    echo "<p class='mensaje-error'>No se recibió término de búsqueda.</p>";
}
?>

</body>
</html>



