<?php

#######################################################################################L2JFROZEN

function updateVisits($db, $wbn)
{
    
    //Send visit duplicate, after divi by two
    $sql = "UPDATE web_name SET total_visit = total_visit + 1 WHERE name = '$wbn' ";
    $run = $db->conn->query($sql);
    $run->execute();
}

function updateStatusTemp($db, $id, $currentStatus)
{

    try {

        $sql = "UPDATE web_temp SET status = '$currentStatus' WHERE id = '$id'";
        $run = $db->conn->query($sql);
        $run->execute();

        return true;
    } catch (\Throwable $th) {

        return false;
    }
}

function updatePass($db, $table, $column_recerence, $data, $new_pw)
{

    $run = $db->conn->query("UPDATE $table SET password = '$new_pw' WHERE $column_recerence = '$data' ");

    if ($run === TRUE)

        return true;
    else
        return false;
}

//83430 148243-3405
function updateUnlock($db, $acc_name, $char_name, $x, $y, $z)
{

    $run = $db->conn->query("UPDATE characters SET x = '$x', y = '$y', z = '$z' WHERE account_name = '$acc_name' AND char_name = '$char_name' ");

    if ($run === TRUE)

        return true;
    else
        return false;
}
#END