<?php
session_start();
ob_start();

require 'vendor/autoload.php';
require 'check-database.php';

use \Firebase\JWT\JWT;

function sessionVerify($key, $time)
{

    $jwt = @$_COOKIE['jwt'];

    if (!empty($jwt)) {

        try {

            $decoded = JWT::decode($jwt, $key, array('HS256'));

            session_unset();

            setcookie("name", $decoded->name, $time + (6 * (60 * 60)));
            setcookie("password", $decoded->password, $time + (6 * (60 * 60)));
            setcookie('jwt', null, 1);
            $_SESSION['id'] = $decoded->id;

            header('Location: ' . BASE_URL);
        } catch (\Exception $e) {

            header('Location: ' . BASE_URL . 'pag/login');
        }
    }
}

function checkSessionEmpty($session)
{

    if (empty($session)) {

        header('Location: ' . BASE_URL . 'pag/login');

        return true;
    } else {
        return false;
    }
}

function checkCookieExp()
{

    //if exist account of cookie X
    if (isset($_COOKIE['name']) and isset($_COOKIE['password'])) {
        if (checkAccountValidationByCookie($_COOKIE['name'], $_COOKIE['password']) == 0) {
            error_log("Cookie empty check flooding" . date("Y-m-d H:i:s") . "\n", 3, "cookie_empty.log");
            session_destroy();
            header('Location: ' . BASE_URL . 'pag/login');
        }
    }

    $jwt = @$_COOKIE['jwt'];
    if (checkSessionEmpty($_SESSION['id']) === false and empty($jwt)) {

        if (empty($_COOKIE['name']) || empty($_COOKIE['password'])) {

            session_destroy();
            header('Location: ' . BASE_URL . 'pag/login');
        }
    }
}

// Parameter 1 GET $_SERVER['REQUEST_URI']
function views($url, $data)
{

    if (isset($url)) {

        $url = explode('/', $url);
        $key = 0;
        $count = count($url);

        for ($i = 0; $i < $count; $i++) {

            if ($url[$i] == 'admin') {
                $key = $i + 1;
                break;
            }
        }

        $div = $url[$key];
        $myUrl = '';
        $count = 0;

        if (!empty($div)) {

            while ($div[$count] != "?" || $div[$count] != "#") {
                $count++;
                $myUrl .= $div[$count - 1];
                if (empty($div[$count + 1]) || $div[$count + 1] == "?" || $div[$count + 1] == "#") { //not will for next because is breaked, naelson.g.saraiva@gmail.com
                    $myUrl .= $div[$count];
                    break;
                }
            }
        }

        if ($myUrl == 'index' || empty($myUrl) == true || $myUrl == 'home') {

            extract($data);

            require 'views/home.php';
        } else {

            if (file_exists('views/' . $myUrl . '.php')) {

                extract($data);

                require 'views/' . $myUrl . '.php';
            } else {

                extract($data);
                include 'views/error.php';
            }
        }
    }
}

function hrefRedirect($router)
{
    echo BASE_URL . $router;
}


function guard($accountId, $password)
{
    if (getAccessLevel($accountId, $password) > 0) {

        return true;
    } else {
        header('Location: ' . BASE_URL);
    }
}

//not need return, because error loop location index
function guardIndex($accountId, $password)
{
    if (getAccessLevel($accountId, $password) > 0) {

        return true;
    } else {
        return false;
    }
}

function admVisible($accountId, $password)
{
    if (getAccessLevel($accountId, $password) > 0) {

        return true;
    } else {

        return false;
    }
}
