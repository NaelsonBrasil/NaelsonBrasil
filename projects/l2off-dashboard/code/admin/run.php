<?php
require 'check-database.php';
require_once '../tools.php';
require 'crud/auth.php';
require 'crud/register.php';
require 'crud/insert.php';
require 'crud/delete.php';
include 'header.php';

$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (!$data == null) {
    switch ($data) {

        case isset($data['form_delete_order']):
            if (delete_order($data['token']) === true)
                echo json_encode(array('success' => true));
            else
                echo json_encode(array('error' => true));
            break;

        case isset($data['webName']): // worked tested
            checkWebNameJson($data['webName']);
            break;

        case isset($data['plan']):
            getTemplatePlan($data['plan'], $data['project'], $data['plataform']);
            break;

        default:
            http_response_code(401);
            echo json_encode(array("request" => "Failed."));
    }
}

if (isset($_POST['user']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['target_register'])) { //Register account

    $tokenClient = $_POST['token_user_recaptacha'];
    $ip = getRealIpAddr();

    $getJ = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKeyRecaptcha&response=$tokenClient&remoteip=$ip");
    $json = json_decode($getJ);
    if ($json->success === $recaptchaEnable) {

        createAccount($_POST['user'], $_POST['email'], $_POST['password']);
    } else {

        $_SESSION['register_error_msg'] = "Recaptcha detect possible flood!";
        $_SESSION['register_error'] = true;
        header('Location: ' . BASE_URL . 'pag/register');
    }
}

if (isset($_POST['email']) and isset($_POST['password']) and isset($_POST['target_login'])) { //Auth Login

    $tokenClient = $_POST['token_user_recaptacha'];
    $ip = getRealIpAddr();

    $getJ = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKeyRecaptcha&response=$tokenClient&remoteip=$ip");
    $json = json_decode($getJ);
    if ($json->success === $recaptchaEnable) {

        authLogin($_POST['email'], $_POST['password'], $timeJwt, $keyJwt);
        
    } else {
        $_SESSION['login_error_msg'] = "Recaptcha detect possible flood!";
        $_SESSION['login_error'] = true;
        header('Location: ' . BASE_URL . 'pag/login');
    }
}
