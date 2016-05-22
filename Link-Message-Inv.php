<?php
    if(isset($_GET['message'])){
        $type = $_GET['message'];
    }else{
        $type = 'inv';
    }
?>
<ul class="nav nav-tabs">
    <li role="presentation" <?php if($type == 'matches'){ echo 'class="active"'; } ?>><a href="?message=matches">Matches</a></li>
    <li role="presentation" <?php if($type == 'inv'){ echo 'class="active"'; } ?>><a href="?message=inv">Messages</a></li>
    <li role="presentation" <?php if($type == 'group'){ echo 'class="active"'; } ?>><a href="?message=group">Groups</a></li>
</ul>
<?php
    include 'Link-DB-Connect.php';
    //find all individual chats for user
    $user_id = $_SESSION['user_id'];
    if ($type == 'matches'){
        $users = $mysqli->prepare("SELECT members.id, members.username FROM members JOIN user_matches ON members.id=user_matches.A OR members.id=user_matches.B WHERE user_matches.A=? OR user_matches.B=?");
        if($users){
            $users->bind_param('ii', $user_id, $user_id);
            $users->execute();
            $users->store_result();
            $users->bind_result($u_id, $u_name);
            if($users->num_rows > 0){
                $chat_name = "";
                while($users->fetch()){
                    if($u_id != $user_id){
                        if(isset($_GET['message'])){
                            echo '<a href ="?message='.$_GET['message'].'&u_id='.$u_id.'"><div class="button">'.$u_name.'</div></a>';

                        }else{
                            echo '<a href ="?u_id='.$u_id.'"><div class="button">'.$u_name.'</div></a>';

                        }
                    }
                }
            }else{
                echo "error";
            }
        }else{
            echo "no user";
        }
    }else{
        $result = $mysqli->prepare("SELECT c.id, group_chat FROM user_chat uc INNER JOIN chat c ON c.id = uc.chat_id WHERE uc.user_id = ?");
        if($result){
            $result->bind_param('i', $user_id);
            $result->execute();
            $result->store_result();
            $result->bind_result($id, $group_chat);
            if($result->num_rows > 0){
                while($result->fetch()){
                    //only fetch individual chats
                    if($type == "inv" && $group_chat == 0 || $type == "group" && $group_chat == 1){
                        $users = $mysqli->prepare("SELECT u.id, username FROM user_chat uc INNER JOIN members u ON u.id = uc.user_id WHERE uc.chat_id = ?");
                        if($users){
                            $users->bind_param('i', $id);
                            $users->execute();
                            $users->store_result();
                            $users->bind_result($u_id, $u_name);
                            if($users->num_rows > 0){
                                $chat_name = "";
                                while($users->fetch()){
                                    if($u_id != $user_id){
                                        if($chat_name != ""){
                                            $chat_name = $chat_name.", ".$u_name;
                                        }else{
                                            $chat_name = $u_name;
                                        }
                                    }
                                }
                                if(isset($_GET['message'])){
                                    echo '<a href ="?message='.$_GET['message'].'&chat_id='.$id.'&chat_name='.$chat_name.'"><div class="button">'.$chat_name.'</div></a>';

                                }else{
                                    echo '<a href ="?chat_id='.$id.'&chat_name='.$chat_name.'"><div class="button">'.$chat_name.'</div></a>';

                                }
                            }else{
                                echo "error";
                            }
                        }else{
                            echo "no user";
                        }
                    }
                }
            }else{
                echo "<p> no messages </p>";
            }
        }
    }
    