<head>
    <script>
        $(document).ready(function () {
            var mb = $("#messages");
            mb.scrollTop(mb.prop("scrollHeight"));
            
            setInterval(function(){
                var last_updated = mb.children().last().attr('time');
                $.post('Link-Get-Messages.php', {lastTime: last_updated}, 
                    function (text) {
                        appendMessage(text);
                    } 
                )
            }, 3000);
            
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
    </script>
</head>
<div id="message_board">
    <div id="messages" class="panel-body">
        <?php
            include 'Link-DB-Connect.php';
            $chat_id = $_GET['chat_id'];
            $_SESSION['chat_id'] = $chat_id;
            $chat_name = $_GET['chat_name'];
        //TODO if chat belongs to user
            $request = $mysqli->prepare("SELECT text, created_at, user_id, user_name FROM message WHERE chat_id = ? ORDER BY created_at");
            if($request){
                $request->bind_param('i', $chat_id);
                $request->execute();
                $request->store_result();
                $request->bind_result($text, $created_at, $user_id, $user_name);
                if($request->num_rows > 0){
                    include 'Link-Message-Template.php';
                }else{
                    echo "no messages";
                }
            }else{
                echo "messages not retrieved";
            }
            echo '</div>';
        ?>
        <div class="panel-footer">
            <form id="form" class="form-horizontal" action="" method="post" enctype="multipart/form-data"><br>
                <input id="field" class="form-control" type="text" name="text" placeholder="type message">
                <input type="hidden" name="chat_id" value="<?php echo $_GET['chat_id']; ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            </form>
        </div>
    </div>
    
</div>