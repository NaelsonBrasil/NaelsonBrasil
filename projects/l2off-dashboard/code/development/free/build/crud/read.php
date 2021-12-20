<?php
#######################################################################################L2JFROZEN
//Rules all variable name crud name
//Check by token and name
function getTemp($db, $wdn, $token)
{

    $run = $db->conn->prepare("SELECT id FROM web_name WHERE name = '$wdn' AND token = '$token' ");
    $run->execute();
    $id = $run->fetchColumn();

    $run = $db->conn->prepare("SELECT * FROM web_temp WHERE web_name_id = '$id' ");

    $run->execute();
    return $run->fetchAll();
}

function verifyLoginAndPassword($db, $login, $password)
{

    $run = $db->conn->query("SELECT * FROM accounts WHERE login = '$login' AND password = '$password' ");

    if ($run->num_rows == 1) {

        return true;
    } else {

        return false;
    }
}

/* Verify if data exist in database no*/
function verifyInDb($db, $table, $column, $data)
{

    $run = $db->conn->query("SELECT * FROM $table WHERE $column = '$data'");

    if ($run->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}

/* GET EMAIL */
function getEmail($db, $table, $column1, $column2, $old_password, $email)
{

    $run = $db->conn->query("SELECT email FROM $table WHERE $column1 = '$old_password' AND $column2  = '$email'");

    if ($run->num_rows == 1) {
        while ($row = $run->fetch_row()) return $row[0];
    } else {
        return 0;
    }
}

//SELECT ALL
function selectCharacters($db, $account_name)
{
    $run = $db->conn->query("SELECT char_name FROM characters WHERE account_name = '$account_name'");
    return $run->fetch_all(MYSQLI_NUM);
}

//GET PASSWORD BY LOGIN
function getPassword($db, $data)
{
    $login = $data['login'];
    $run = $db->conn->query("SELECT password FROM accounts WHERE login = '$login' ");
    $result = '';
    if ($run->num_rows == 1) {
        while ($row = $run->fetch_row()) {
            $result = $row[0];
            $run->close();
        }
    } else {
        return 0;
    }

    return $result;
}

#END
