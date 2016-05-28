<div class="user-head info">
    <div class="username"><?php echo $username ?></div>
    <div class="location"><?php echo $city ?><?php echo $state ?></div>
</div>

<div class="type-of-climbing info">
    <h4>Type of Climber</h4>
    <div class="info-container">
        <?php 
        if ($boulder != null){
            if ($boulder == 'y'){
                echo "Boulderer";
            }else{
                echo "Boulderer ".$boulder;
            }
        }
        ?><br>
        <?php 
        if ($sport != null){
            if ($sport == 'y'){
                echo "Sport Climber";
            }else{
                echo "Sport Climber ".$sport;
            }
        }
        ?><br>
        <?php 
        if ($trad != null){
            if ($trad == 'y'){
                echo "Trad Climber";
            }else{
                echo "Trad Climber ".$trad;
            }
        }
        ?>
    </div>
</div>
<div class="about info">
    <h4>About</h4>
    <div class="info-container">
        <?php echo $bio ?>
    </div>
</div>