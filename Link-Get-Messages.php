<?php
    include 'Link-Secure-Session.php';
    include_once 'Link-DB-Connect.php';
    
    secure_session_start();
    $request = $mysqli->prepare("SELECT * FROM message WHERE chat_id=? AND created_at > ?");
    if($request){
        $request->bind_param("is",$_SESSION['chat_id'], $_POST['lastTime']);
        $request->execute();
        $request->store_result();
        $request->bind_result($id, $text, $created_at, $user_id, $chat_id);
        if($request->num_rows > 0){
            include 'Link-Message-Template.php';
        }
    }
    
    