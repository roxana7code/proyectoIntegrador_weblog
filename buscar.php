<?php
if (isset($_GET['q'])) {
    $busqueda = htmlspecialchars($_GET['q']);
    echo "<h1>Resultados para: <em>$busqueda</em></h1>";
    include('conexion.php'); 

    $query = "SELECT * FROM publicaciones WHERE titulo LIKE '%$busqueda%' OR contenido LIKE '%$busqueda%'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<div class='resultado'>";
            echo "<h3>" . $fila['titulo'] . "</h3>";
            echo "<p>" . substr($fila['contenido'], 0, 100) . "...</p>";
            echo "<a href='verPublicacion.php?id=" . $fila['id'] . "'>Leer más</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }
}
?>

