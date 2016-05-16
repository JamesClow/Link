<?php
    include 'Link-Secure-Session.php';
    secure_session_start();
    $_SESSION = array();
    $params = session_get_cookie_params();
    setcookie(session_name(),'',time()-10000);
    session_destroy();
    header('Location: ./Link-Login.php');