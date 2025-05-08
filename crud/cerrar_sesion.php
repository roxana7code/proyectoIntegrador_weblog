<?php
session_start();
session_destroy();
header("location:/inicioSesion.php");

?>