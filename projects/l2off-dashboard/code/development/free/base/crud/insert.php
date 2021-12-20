<?php
#######################################################################################L2JFROZEN

/* Create account */
function createAcc($db, $data = array())
{
    $login = $data["login"];
    $password = $data["password"];
    $email = $data["email"];
    $time = $data["time"];
    $ip = $data["ip"];
    
    $run = $db->conn->query("INSERT INTO accounts (login,password,lastactive,access_level,lastIP,lastServer,email) VALUE('$login','$password','$time',0,'$ip',1,'$email')");
    
    if ($run === TRUE)
        return true;
    else
        return false;
}
#END