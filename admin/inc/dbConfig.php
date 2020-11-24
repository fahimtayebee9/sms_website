<?php
    $serverName = "localhost";
    $userName   = "root";
    $password   = "";
    $database   = "sms_website";

    function dbConnection(){
        global $serverName;
        global $userName;
        global $password;
        global $database;
        
        $dbCon = mysqli_connect("localhost","root","","sms_website");
        
        return $dbCon;
        
    }
?>