<div class="row">
    <div class="col-xs-12 header">
        <h3>Banner</h3>
        <a href="Link-Secure-Logout.php">Logout</a>
    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <?php // select which messageing system to view
            include 'Link-Message-Inv.php';
        ?>
    </div>
    <div class="col-xs-8">
        <?php // is the user new / do they already have messages
        if(isset($_GET['chat_id']) && isset($_GET['chat_name'])){
            include 'Link-Board-Message.php';
        }else{
            include 'Link-Board-Welcome.php';
        }
        ?>
    </div>
</div>