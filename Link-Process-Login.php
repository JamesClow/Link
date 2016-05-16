<?php
    include 'Link-Secure-Session.php';
    include 'Link-Secure-Login.php';
    include_once 'Link-DB-Connect.php';

    error_log("Step 0");
    secure_session_start();
    if(isset($_POST['username'], $_POST['password'])){
        error_log("Step 1");
        $username = $_POST['username'];
        $password = $_POST['pass'];
        if(login($username, $password, $mysqli)){
            header('Location: Link-Home.php');
        }else{
            header('location: Link-Login.php?error=invalid');
        }
    }else{
        echo "invalid request";
    }
