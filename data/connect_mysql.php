<?php

    $servername = "localhost";
    $username = "root";
    $password = "Qwe456123";


    // Create connection
    $mysqli = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    if (!$mysqli->set_charset("utf8")) {
        printf("Error loading character set utf8: %s\n", $mysqli->error);
        exit();
    }    
    
    mysqli_select_db($mysqli, "comcar");