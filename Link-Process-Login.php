<?php
    include 'Link-Secure-Session.php';
    include 'Link-Secure-Login.php';
    include_once 'Link-DB-Connect.php';

    secure_session_start();

    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['pass'];
        if(login($username, $password, $mysqli)){
            header('Location: Link-Home.php');
        }else{
            header('Location: Link-Home.php?error=invalid');
        }
    }else{
        echo "invalid request";
    }
