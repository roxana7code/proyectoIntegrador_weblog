<?php

function connection(){
    $host = "localhost";
    $user = "root";
    $password = "";

    $bd = "blog_database";

    $connect = mysqli_connect($host, $user, $password);

    mysqli_select_db($connect, $bd);

    return $connect;
};

?>