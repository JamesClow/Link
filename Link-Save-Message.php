<?php
    include 'Link-Secure-Session.php';
    include 'Link-Check-Login.php';
    include_once 'Link-DB-Connect.php';

    secure_session_start();
    if(check_login($mysqli) == true){
        if(isset($_POST['text']) && isset($_POST['user_id']) && isset($_POST['chat_id'])){
            //add new message to database
            $request = $mysqli->prepare("INSERT INTO message (text, user_id, chat_id) VALUES (?,?,?)");
            //update chat last_updated time
            $update = $mysqli->prepare("UPDATE chat SET last_updated=NOW() WHERE id=?");
            
            if($request && $update){
                $update->bind_param("i", $_POST['chat_id']);
                $request->bind_param("sii", $_POST['text'], $_POST['user_id'], $_POST['chat_id']);
                $update->execute(); 
                $request->execute();
                
                echo $_POST['text'];
            }else{
                echo"Message was not sent";
            }
        }else{
            echo "Message was not sent";
        }
    }else{
        echo "User not logged in";
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

