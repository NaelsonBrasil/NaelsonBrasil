<?php
require '../tools.php';
require 'DbConnect.php';
require 'vendor/autoload.php';

use \Firebase\JWT\JWT;

/**
 * Verify if data exist in table
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.1.2
 *
 * @param string $table  The name table for search
 * @param string $column The name column for search
 * @param string $insertion The data for verify
 * @return bool 1 exist or 0 don't exist
 */
function verifyData($table, $column, $data)
{
    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT $column FROM $table WHERE $column = '$data' ");
    $run->execute();
    return $run->rowCount();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param string $Get password by email
 */
function getPassword($email)
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT password FROM account WHERE email='$email'");

    $run->execute();
    return  $run->fetchColumn();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param string $Get status by email
 */
function verifyPenalityAcc($email)
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT status FROM account WHERE email = '$email' ");

    $run->execute();
    return  $run->fetchColumn();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param string $Get password by email
 */
function getName($email)
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT name FROM account WHERE email='$email'");

    $run->execute();
    return  $run->fetchColumn();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param string $email for search id
 * @return int id
 */
function getIdAccount($email)
{
    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT id FROM account WHERE email='$email'");

    $run->execute();
    return  $run->fetchColumn();
}

function checkWebNameJson($webName)
{

    $inWebName = inputProtec($webName);
    $size = strlen($inWebName);

    if (!empty($inWebName) and preg_match("/^[a-zA-Z0-9]+$/", $inWebName) == 1) {

        if ($size <= 30) {

            if (verifyData('web_name', 'name', $inWebName) == 1 || strtolower($inWebName) == 'admin') { //Protect action http://localhost/admin/

                echo json_encode(array('already' => true));
            } else {

                echo json_encode(array('success' => true, 'name' => $inWebName));
            }
        } else {

            echo json_encode(array("size" => true));
        }
    } else {

        echo json_encode(array("empty" => true));
    }
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param id $Get Accesslevel by id
 * @param return access level number
 */
function getAccessLevel($accountId, $password)
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT access_level FROM account WHERE id = '$accountId' AND password = '$password'");

    $run->execute();
    return  $run->fetchColumn();
}


/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param plan
 * @param return fechAll
 */
function getTemplatePlan($plan, $project, $plataform)
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT * FROM template WHERE  free = '$plan' and project = '$project' and plataform = '$plataform' ");
    $run->execute();
    echo json_encode($run->fetchAll());
}

/**
 * Protection control cookies no proceding account
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param id $Get Accesslevel by id
 * @param return access level number
 */
function checkAccountValidationByCookie($name,$password)
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT * FROM account WHERE name = '$name' AND password = '$password'");
    $run->execute();
    return  $run->rowCount();

}