<?php

    session_start();

    $server = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "univ";

    $conn = mysqli_connect($server, $username, $password, $dbname);
?>