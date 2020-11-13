<?php
    $serverName = "localhost";
    $userName   = "root";
    $password   = "";
    $database   = "sms_website";

    $db = mysqli_connect($serverName,$userName,$password,$database);

    if(!$db){
        ?>
            <div class="alert alert-danger">
                <?=mysqli_error($db)?>
            </div>
        <?php
    }

?>