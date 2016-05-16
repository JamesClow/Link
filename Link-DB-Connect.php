<?php
    $servername = "localhost";
    $username = "jameclow";
    $password = "eYeHerm.os";
    $dbname = "jameclow";

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if (!$mysqli){
        die("Connection failed" . mysqli_connect_error());
    }
