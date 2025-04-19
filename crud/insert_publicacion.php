<?php 
include("connection.php");
$con = connection();

$publicacion = null;
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$contenido = $_POST['contenido'];
$resumen = $_POST['resumen'];
$imagen = $_POST['imagen'];
$fecha = $_POST['fecha'];

$sql = "INSERT INTO publicaciones (titulo, autor, contenido, resumen, imagen, fecha) 
        VALUES ('$titulo', '$autor', '$contenido', '$resumen', '$imagen', '$fecha')";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: index.php");
};

?>