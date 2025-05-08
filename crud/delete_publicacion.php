<?php
include("connection.php");
$con = connection();

$publicacion=$_GET['publicacion'];

$sql = "DELETE FROM publicaciones WHERE publicacion='$publicacion'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: /crud/indexCrud.php");
} else {
    echo "Error al actualizar la publicación.";
}
?>