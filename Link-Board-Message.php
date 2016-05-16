<head>
    <script>
        $(document).ready(function () {
            var mb = $("#message_board");
            mb.scrollTop(mb.prop("scrollHeight"));
            
            $("#form").submit(function () {
                $.ajax({
                    url: 'Link-Save-Message.php',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (text) {
                        var str = '<p>'.concat(text.toString()).concat("</p>");
                        mb.append(str);
                        mb.animate({scrollTop: mb.prop("scrollHeight") - mb.height()});
                        
                    }
                });
                return false;
            });
        });
    </script>
</head>
<?php
    include 'Link-DB-Connect.php';
    //find all individual chats for user
    //$user_id = $_SESSION['user_id'];
    $chat_id = $_GET['chat_id'];
    $chat_name = $_GET['chat_name'];
    echo "<h3>".$chat_name."</h3>";
    echo '<div id="message_board">';
    $result = $mysqli->prepare("SELECT text, user_id FROM message WHERE chat_id = ? ORDER BY created_at");
    if($result){
        $result->bind_param('i', $chat_id);
        $result->execute();
        $result->store_result();
        $result->bind_result($text, $user_id);
        if($result->num_rows > 0){
            while($result->fetch()){
                echo "<p>".$text."</p>";
            }
        }else{
            echo "no messages";
        }
    }else{
        echo "messages not retrieved";
    }
    echo '</div>';
?>
<form id="form" action="" method="post" enctype="multipart/form-data"><br>
    <input type="text" name="text">
    <input type="hidden" name="chat_id" value="<?php echo $_GET['chat_id']; ?>">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    <input type="submit" value="Send" name="submit"> 
</form>