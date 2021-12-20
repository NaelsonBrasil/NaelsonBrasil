<?php
function delete_all_temp($id_w_b_n)
{

    try {

        $dbc = new DbConnect();
        $run = $dbc->conn->prepare("DELETE FROM web_temp WHERE web_name_id = '$id_w_b_n' ");
        $run->execute();
        return true;
    } catch (PDOException $e) {

        return false;
    }
}

function delete_all_web_name($id_w_b_n)
{

    try {

        $dbc = new DbConnect();
        $run = $dbc->conn->prepare("DELETE FROM web_name WHERE id = '$id_w_b_n'");
        $run->execute();
        return true;
    } catch (PDOException $e) {

        return false;
    }
}


function delete_order($token)
{

    try {

        $dbc = new DbConnect();
        $run = $dbc->conn->prepare("DELETE FROM orders WHERE token = '$token' ");
        $run->execute();
        return true;
        
    } catch (PDOException $e) {
        return false;
    }
}