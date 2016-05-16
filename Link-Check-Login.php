<?php
    function check_login($mysqli){
        if(isset($_SESSION['user_id'],$_SESSION['user_name'],$_SESSION['login_string'])){
            
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['user_name'];
            $login_string = $_SESSION['login_string'];
            
            $result = $mysqli->prepare("SELECT password FROM members WHERE id = ? Limit 1");
            if($result){
                $result->bind_param('i', $user_id);
                $result->execute();
                $result->store_result();
                
                if($result->num_rows == 1){
                    $result->bind_result($password);
                    $result->fetch();
                    $login_check = hash('sha512', $password, $user_browser);
                    if (hash_equals($login_check, $login_string)){
                        //login sucessful
                        return true;
                    
                    }else{
                        return false;
                    }
                        
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
        return false;
    }
