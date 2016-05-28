<?php
    $user_request = $mysqli->prepare("SELECT username, state, city, boulder, sport, trad, bio FROM members WHERE id=? LIMIT 1");
    if($user_request){
        $user_request->bind_param("i", $_GET['u_id']);
        $user_request->execute();
        $user_request->store_result();
        $user_request->bind_result($username, $state, $city, $boulder, $sport, $trad, $bio);
        if($user_request->num_rows > 0){
            $user_request->fetch();
            echo '<div id="user-info-container" class="row">';
                include 'Link-User-Info-Template.php';
            echo '</div><br>';
            echo '<div id="message-container" class="row">';
                include 'Link-Board-Message.php';
            echo '</div>';
        }else{
            echo "User not found";
        }
    }else{
        echo "failed to get users";
    }

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

