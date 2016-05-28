<?php
include 'Link-DB-Connect.php';
//get user group
//TODO select user group based on common location

$user_request = $mysqli->prepare("SELECT id, username FROM members");
if($user_request){
    $user_request->execute();
    $user_request->store_result();
    $user_request->bind_result($id, $username);

    $user_array = [];

    //$create = $mysqli->prepare("INSERT INTO matches (userA, userB, relation) VALUES (1,2,'testing')");
    //$create->execute();

    if($user_request->num_rows > 0){
        while($user_request->fetch()){
            $user_array[] = $id;
        }
        for($i = 0; $i < count($user_array)-1; $i++){
            for($j = $i+1; $j < count($user_array); $j++){
                $user_a = $user_array[$i];
                $user_b = $user_array[$j];
                //does match already exist
                $match_request = $mysqli->prepare("SELECT * FROM user_matches WHERE (A=? AND B=?) OR (A=? AND B=?)");
                if($match_request){
                    $match_request->bind_param('ssss', $user_a, $user_b, $user_b, $user_a);
                    $match_request->execute();
                    $match_request->store_result();
                    if ($match_request->num_rows <= 0){
                        $new_chat = $mysqli->prepare("INSERT INTO chat (group_chat) VALUES (0)");
                        $new_chat->execute();
                        $chat_id = $mysqli->insert_id;
                        //create new match
                        $create_match = $mysqli->prepare("INSERT INTO user_matches (A, B, relation, chat_id) VALUES (?,?,'matched',?)");
                        if($create_match){
                            $create_match->bind_param("iii", $user_a, $user_b,$chat_id);
                            $create_match->execute();
                            error_log("success");

                        }
                        $create_match = null;
                    } 
                }
                $match_request = null; 
            } 
        }
    }
}else{
    error_log("could not connect to member db");
}
