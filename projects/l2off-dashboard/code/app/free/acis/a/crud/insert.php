<?php
#######################################################################################L2JFROZEN

/* Create account */
function createAcc($db, $data = array())
{
    $login = $data["login"];
    $password = $data["password"];
    $time = $data["time"];
    $accessLevel = $data["access_level"];

    $run = $db->conn->query("INSERT INTO accounts (login,password,lastactive,access_level,lastServer) VALUE('$login','$password','$time',$accessLevel,1)");
    
    if ($run === TRUE)
        return true;
    else
        return false;
}
#END