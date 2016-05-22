<?php
    include 'Link-Secure-Session.php';
    include 'Link-Secure-Login.php';
    include_once 'Link-DB-Connect.php';
    
    secure_session_start();
    
    $message = "";
    
    if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['pass'])){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message .= "this is not a valid email";
        }
        
        $request = $mysqli->prepare("SELECT id FROM members WHERE username = ? LIMIT 1");
        if ($request){
            $request->bind_param('s', $username);
            $request->execute();
            $request->store_result();
            if($request->num_rows == 1){
                $message .= "username already exists<br>";
                $request->close();
            }
        }else{
            $message .= "DB error<br>";
            $request->close();
        }
        
        $request = $mysqli->prepare("SELECT id FROM members WHERE email = ? LIMIT 1");
        if ($request){
            $request->bind_param('s', $email);
            $request->execute();
            $request->store_result();
            if($request->num_rows == 1){
                $message .= "email already exists<br>";
            }
        }else{
            $message .= "DB error<br>";
        }
        
        if($message == ''){
            $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
            $insert = $mysqli->prepare("INSERT INTO members (username, password, email) VALUES (?,?,?)");
            if($insert){
                $insert->bind_param("sss",$username,$password,$email);
                $insert->execute();
                if(login($username, $_POST['pass'], $mysqli)){
                    header('Location: ./Link-Home.php?member=new');
                }else{
                    header('location: ./Link-Home.php?error=invalid');
                }
            }
            
        }else{
            header('Location: ./Link-Home.php');
        }
    }