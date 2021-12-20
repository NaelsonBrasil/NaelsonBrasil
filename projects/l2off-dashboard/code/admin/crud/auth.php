<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

session_start();

function authLogin($email, $password, $time, $key)
{
    $inEmail = inputProtec($email);
    $inPassword = inputProtec($password);

    if (!empty($email) and !empty($password)) {

        if (verifyData('account', 'email', $inEmail) == 1) {

            if (password_verify($inPassword, getPassword($inEmail))) {

                setcookie('name', null, -1);
                setcookie('password', null, -1);

                $token = array(
                    "iss" => "http://example.org",
                    "aud" => "http://example.com",
                    "iat" => $time,
                    "exp" => $time + (1 * 60),
                    "id"  => getIdAccount($inEmail),
                    'name' => getName($inEmail),
                    'password' => getPassword($inEmail)
                    // "nbf" => 1357000000
                );

                $jwt = JWT::encode($token, $key);

                setcookie("jwt", $jwt, $time + (6 * (60 * 60)));
                header('Location: ' . BASE_URL);
                
            } else {
                $_SESSION['login_error_msg'] = "Password not match";
                $_SESSION['login_error'] = true;
                header('Location: ' . BASE_URL . 'pag/login');
            }
        } else {
            $_SESSION['login_error_msg'] = "Email not registred";
            $_SESSION['login_error'] = true;
            header('Location: ' . BASE_URL . 'pag/login');
        }
    } else {
        $_SESSION['login_error_msg'] = "Empty";
        $_SESSION['login_error'] = true;
        header('Location: ' . BASE_URL . 'pag/login');
    }
}
