<head>
    <script>
        window.onresize = setEqualHeight;
        
        $(document).ready(function () {
            var mb = $("#messages");
            mb.scrollTop(mb.prop("scrollHeight"));
            
            setEqualHeight();
            
            setInterval(function(){
                var last_updated = mb.children().last().attr('time');
                $.post('Link-Get-Messages.php', {lastTime: last_updated}, 
                    function (text) {
                        appendMessage(text);
                    } 
                )
            }, 1000);
            
            $("#form").submit(function () {
                $.ajax({
                    url: 'Link-Save-Message.php',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (text) {
                        appendMessage(text);
                    }
                });
                return false;
            });
            
            function appendMessage(text){
                if(text){
                    mb.append(text);
                    mb.animate({scrollTop: mb.prop("scrollHeight") - mb.height()});
                    $("#field").val('');
                }
            }
        });
        
        function setEqualHeight() {
            $('.panel-body').height($(window).height() - $('#user-info-container').height() - 220);

        }

    </script>
</head>
<div id="message_board_head">
    <h4>Messages</h4>
</div>
<div id="message_board">
    <div id="messages" class="panel-body">
        <?php
        
            include 'Link-DB-Connect.php';
//TODO if chat belongs to user
            $request_chat_id = $mysqli->prepare("SELECT chat_id FROM user_matches WHERE (A=? AND B=?) OR (A=? AND B=?)");
            if($request_chat_id){
                $request_chat_id->bind_param("iiii", $_SESSION['user_id'], $_GET['u_id'], $_GET['u_id'],  $_SESSION['user_id']);
                $request_chat_id->execute();
                $request_chat_id->store_result();
                $request_chat_id->bind_result($chat_id);
                if($request_chat_id->num_rows > 0){
                    while($request_chat_id->fetch()){
                        if($chat_id != ""){
                            $_SESSION['chat_id'] = $chat_id;
                            $request = $mysqli->prepare("SELECT text, created_at, user_id, user_name FROM message WHERE chat_id = ? ORDER BY created_at");
                            if($request){
                                $request->bind_param('i', $chat_id);
                                $request->execute();
                                $request->store_result();
                                $request->bind_result($text, $created_at, $user_id, $user_name);
                                if($request->num_rows > 0){
                                    include 'Link-Message-Template.php';
                                }else{
                                    echo "Say Hello!";
                                }
                            }else{
                                echo "messages not retrieved";
                            }
                        }   
                    }
                }else{
                    //chat has not been initalized
                }
            }
        ?>
    </div>
    <div class="panel-footer">
        <form id="form" class="form-horizontal" action="" method="post" enctype="multipart/form-data"><br>
            <input id="field" class="form-control" type="text" name="text" placeholder="type message">
            <input type="hidden" name="chat_id" value="<?php echo $_SESSION['chat_id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="u_id" value="<?php echo $_GET['u_id']; ?>">
        </form>
    </div>
</div>