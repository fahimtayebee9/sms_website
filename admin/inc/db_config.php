<?php
    $serverName = "localhost";
    $userName   = "root";
    $password   = "";
    $database   = "sms_website";

    $db = mysqli_connect($serverName,$userName,$password,$database);

    if(!$db){
        ?>
            <div class="alert">
                <?=mysqli_error($db)?>
            </div>
        <?php
    }


?>