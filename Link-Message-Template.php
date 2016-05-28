<?php
    $result = "";
    while($request->fetch()){
        if($_SESSION['user_id'] == $user_id){
            $result = $result.'<div class="message self" time="'.$created_at.'">'
                    . '<div class="message-head">'
                    . '<small>'
                    .$user_name
                    . '<span class="pull-right glyphicon glyphicon-time">'
                    .$created_at
                    . '</span>'
                    .'</small>'
                    . '</div>'
                    . '<div class="message-body">'
                    . $text
                    . '</div>'
                    . '</div>';
        }else{
            $result = $result.'<div class="message other" time="'.$created_at.'">'
                    . '<div class="message-head">'
                    . '<small>'
                    .$user_name
                    . '<span class="pull-right glyphicon glyphicon-time">'
                    .$created_at
                    . '</span></small>'
                    . '</div>'
                    . '<div class="message-body">'
                    . $text
                    . '</div>'
                    . '</div>';
        }
    }
    echo $result;
