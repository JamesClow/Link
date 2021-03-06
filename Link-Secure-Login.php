<?php
    function login($username, $password, $mysqli){
        $request = $mysqli->prepare("SELECT id, username, password FROM members WHERE username = ? LIMIT 1");
        if($request){
            $request->bind_param('s', $username);
            $request->execute();
            $request->store_result();
            
            $request->bind_result($user_id, $user_name, $user_password);
            $request->fetch();
            
            if($request->num_rows == 1){
                if (password_verify($password, $user_password)){
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['user_id'] = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_name'] = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user_name);
                    $_SESSION['login_string'] = hash('sha512', $user_password, $user_browser);
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }
