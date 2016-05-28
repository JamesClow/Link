<div class="row">
    <div class="col-xs-4 no-padding">
        <div class="row">
            <div class="col-xs-12 title no-padding">
                <div class="banner LINK">Link</div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 me">
                <a class="user-name" href="Link-Home.php?u_id=<?php echo $_SESSION['user_id'];?>"><?php echo $_SESSION['user_name']; ?></a><br>
                <a href="Link-Secure-Logout.php">Logout</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 nav-container">
                <?php // select which messageing system to view
                    include 'Link-Message-Inv.php';
                ?>
            </div>
        </div>      
    </div>
    <div class="col-xs-8 content">
        
        <div class="row">
            <div class="col-xs-12 body-content">
                <?php // is the user new / do they already have messages
                if (isset ($_GET['u_id'])){
                    if ($_SESSION['user_id'] == $_GET['u_id']){
                        include 'Link-Edit-Info.php';
                    }else{
                        include 'Link-User-Info.php';

                    }
                }else{
                    include 'Link-Board-Welcome.php';
                }
                ?>
            </div>
        </div>
    </div>
</div>