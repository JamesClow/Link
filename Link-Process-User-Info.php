<?php
    include 'Link-Secure-Session.php';
    include 'Link-Secure-Login.php';
    include_once 'Link-DB-Connect.php';

    secure_session_start();
    
    $city = '';
    $zip = '';
    $boulder = '';
    $sport = '';
    $trad = '';
    $bio = '';
    
    if(isset($_POST['city']) && isset($_POST['zipcode'])){
        $city = $_POST['city'];
        $zip = $_POST['zipcode'];
        if(isset($_POST['bouldering'])&&$_POST['bouldering']==true){
            if(isset($_POST['bouldering_grade'])&&$_POST['bouldering_grade']!="null"){
                $boulder = $_POST['bouldering_grade'];
            }else{
                $boulder = "y";
            }
        }
        if(isset($_POST['sport'])&&$_POST['sport']==true){
            if(isset($_POST['sport_grade'])&&$_POST['sport_grade']!="null"){
                $sport = $_POST['sport_grade'];
            }else{
                $sport = 'y';
            }
        }
        if(isset($_POST['trad'])&&$_POST['trad']==true){
            if(isset($_POST['trad_grade'])&&$_POST['trad_grade']!="null"){
                $trad = $_POST['trad_grade'];
            }else{
                $trad = 'y';
            }
        }
        if(isset($_POST['bio'])){
            $bio = $_POST['bio'];
        }
        $insert = $mysqli->prepare("UPDATE members SET city=?, zip=?, boulder=?, sport=?, trad=?, bio=? WHERE id=?");
        if($insert){
            $insert->bind_param("sissssi", $city, $zip, $boulder, $sport, $trad, $bio, $_SESSION['user_id']);
            $insert->execute();
            if($mysqli->affected_rows > 0){
                include 'Link-Match-Users.php';
                header('Location: ./Link-Home.php');
            }
        }        
    }
    header('Location: ./Link-Home.php');
    
    
    
