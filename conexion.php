<?php

function connection() {
    $host = "localhost";
    $user = "root";
    $pass = ""; 
    $db = "blog_database";

    $con = mysqli_connect($host, $user, $pass, $db);

    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $con;
}

?>