<?php

    session_start();

    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "univ_trial_n_error";

    $conn = mysqli_connect($server, $username, $password, $dbname);

?>