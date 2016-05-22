<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="Link-Style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        include 'Link-Secure-Session.php';
        include 'Link-Check-Login.php';
        include_once 'Link-DB-Connect.php';

        secure_session_start();
        if(check_login($mysqli) == true){
            if(isset($_GET['member'])&&$_GET['member']=="new"){
                include 'Link-Create-User-Info.php';
            }else{
                include 'Link-Active.php';
            }
        }else{
            if(isset($_GET['register'])&&$_GET['register']=='true'){
                include 'Link-Register.php';
            }else{
                include 'Link-Login.php';
            }
        }
        ?>
    </body>
</html>


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

