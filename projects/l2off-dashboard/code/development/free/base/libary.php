<?php
session_start();
ob_start();

require 'crud/insert.php';
require 'crud/read.php';
require 'crud/update.php';
require 'crud/delete.php';

$directoryRoot = '';
$ddir = getcwd();

$config = parse_ini_file("baseDBConfig.ini");

//PRODUCTION OR DEVELOPMENT ACTIVE AUTOMATICALY
if ($config['product'] == "production") {

    $myConfigFileName = '';
    $allFiles = glob($ddir . '/*.*');

    for ($i = 0; $i < strlen($ddir); $i++) {

        if ($ddir[$i + 1] == 'a' and $ddir[$i + 2] == 'p' and $ddir[$i + 3] == 'p')
            break;

        $directoryRoot .= $ddir[$i];
    }

    for ($i = 0; $i < count(glob($ddir . '/*.*')); $i++) {

        for ($j = 0; $j < strlen($allFiles[$i]); $j++) {

            // Array
            // (
            //     [0] => 
            //     [1] => opt
            //     [2] => lampp
            //     [3] => htdocs
            //     [4] => lin2web
            //     [5] => app
            //     [6] => free
            //     [7] => frozen
            //     [8] => base
            //     [9] => df7aaa3938f52582df450283d17dfa8e.txt 38 + 32 = 70 anticonflict with cfg.txt two text in index
            // )

            if (@$allFiles[$i][$j + 1] . @$allFiles[$i][$j + 2] . @$allFiles[$i][$j + 3] . @$allFiles[$i][$j + 4] == ".txt" and strlen($allFiles[$i]) > 60) { //anticonflict with cfg.text

                $exploded = explode("/", $allFiles[$i]);

                for ($k = 0; $k < count($exploded); $k++) {

                    if (strlen($exploded[$k]) > strlen(@$exploded[$k + 1])) {

                        $myConfigFileName = @$exploded[$k];
                    } else {

                        $myConfigFileName = @$exploded[$k + 1];
                    }
                }
            }
        }
    }
} else if ($config['product'] == "development") {

    $myConfigFileName = "";
    $allFiles = glob($ddir . '/*.*');

    for ($i = 0; $i < strlen($ddir); $i++) {

        if ($ddir[$i + 1] . $ddir[$i + 2] . $ddir[$i + 3] == 'dev') //development folder and break
            break;

        $directoryRoot .= $ddir[$i];
    }
}

if ($config['product'] == "production") {

    error_reporting(0);

    require $directoryRoot . '/db/Mysql.php';
    require $directoryRoot . '/db/administrator.php';

    $myData = getDataConfig(null, $myConfigFileName, $config['system']);
} else if ($config['product'] == "development") {

    error_reporting(1);

    require $directoryRoot . '/db/Mysql.php';
    require $directoryRoot . '/db/administrator.php';
    $myData = getDataConfig(null, "baseConfig.txt", $config['system']);

    $baseDir = getcwd(); //folder application
    $baseApp = '';
    $key = NULL;

    switch ($config['system']) {

        case 'linux':
            for ($i = 0; $i < strlen($baseDir); $i++) {

                if (@$baseDir[$i + 1] . @$baseDir[$i + 2] . @$baseDir[$i + 3] == 'dev') { //root website

                    if ($key == null) $key = $i;

                    $resize = strlen($baseDir) -  $i;

                    for ($j = 0; $j < $resize; $j++) {

                        if ($key == NULL) echo "Error";

                        else if ($key > 0) {

                            $key += 1;

                            $baseApp .= $baseDir[$key]; // get after development folder exemple development/free/build

                            if (@$baseDir[$key + 1] == null) break;
                        }
                    }
                }
            }
            break;

        case 'windows':

            for ($i = 0; $i < strlen($baseDir); $i++) {

                if (@$baseDir[$i + 1] . @$baseDir[$i + 2] . @$baseDir[$i + 3] == 'dev') { //root website

                    if ($key == null) $key = $i;

                    $resize = strlen($baseDir) -  $i;

                    for ($j = 0; $j < $resize; $j++) {

                        if ($key == NULL) echo "Error";

                        else if ($key > 0) {

                            $key += 1;

                            if ($baseDir[$key] == "\\")  $baseDir[$key] = "/"; // Fix for linux
                            $baseApp .= $baseDir[$key]; // get after development folder exemple development/free/build

                            if (@$baseDir[$key + 1] == null) break;
                        }
                    }
                }
            }
            break;
    }


    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    $url = ''; //current url base folder

    $countBArFull = 0;
    for ($i = 0; $i < strlen($actual_link); $i++) {

        if ($actual_link[$i] == '/') $countBArFull += 1;
    }

    $countBarIndefined = 0;
    for ($i = 0; $i < strlen($actual_link); $i++) {

        if ($actual_link[$i] == '/') {
            $countBarIndefined += 1;

            if ($countBarIndefined == $countBArFull) {
                break;
            }
        }

        $url .= $actual_link[$i];
    }


    $baseUrlApp = $url . '/' . $baseApp . '/';
}

$dbSrv = new Mysql($myData['ip'], $myData['user'], $myData['password'], $myData['dbn1'],  $myData['port']);
$dbAdmin = new DbConnect();

if (isset($_GET['pag'])) {

    $pag = $_GET['pag'];
}

function dinamicPag($myPag, $db, $textCfg, $baseUrl, $currentUrl, $response)
{

    switch ($myPag) {

        case '':

            require 'pags/' . $textCfg['staticPage'] . '.php'; // Fixed
            break;

        case 'main':
            require 'pags/' . $textCfg['staticPage'] . '.php'; // Fixed
            break;

        case 'login':
            require 'pags/login.php';
            break;

        case 'download':
            require 'pags/download.php';
            break;

        case 'rules':
            require 'pags/rules.php';
            break;

        case 'info':
            require 'pags/info.php';
            break;

        case 'register':
            require_once 'pags/register.php';
            break;

        case 'boss':
            require_once 'pags/boss.php';
            break;

        case 'rank':
            require_once 'pags/rank.php';
            break;

            /* BEGIN ADMIN */

        case 'admin-home':

            require 'pags/' . $textCfg['staticPage'] . '.php'; // Fixed
            require 'pags/admin_home.php';
            break;

        case 'admin-password':
            require 'pags/' . $textCfg['staticPage'] . '.php'; // Fixed
            require 'pags/admin_password.php';
            break;

        case 'admin-unlock':
            require 'pags/' . $textCfg['staticPage'] . '.php'; // Fixed
            require 'pags/admin_unlock.php';
            break;

        case 'admin-recover-pw':
            require 'pags/' . $textCfg['staticPage'] . '.php'; // Fixed
            require 'pags/admin_recover_pw.php';
            break;

        case 'admin-contact':
            require 'pags/' . $textCfg['staticPage'] . '.php'; // Fixed
            require 'pags/admin_contact.php';
            break;

            /* END ADMIN */

        default:
            require 'pags/error.php';
            break;
    }
}

#################################Functions#####################################

function checkExpiredByData($db, $wdn, $token)
{

    $allDataTemp = getTemp($db, $wdn, $token);
    $currentDate = date('Y-m-d');

    if (strtotime($currentDate) >= strtotime($allDataTemp[0]['end_data'])) {

        return updateStatusTemp($db, $allDataTemp[0]['id'], "inactive");
    } else {

        return false;
    }
}

if ($config['product'] == "production") {

    //Initialize check if expired webName
    $verifyExpired = checkExpiredByData($dbAdmin, $config['wbn'], $config['wtoken']);
}

function getRealIpAddr()
{

    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {

        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return  $ip;
}

if (!empty(getRealIpAddr())) {

    updateVisits($dbAdmin, $config['wbn']);
}

//L2JFROZEN Project
function inputProtec($str): string
{
    $spaceRemove = preg_replace('/\s+/', '', $str);
    return addslashes(strip_tags(trim(htmlspecialchars($spaceRemove))));
}

function encryptJ($password)
{
    return base64_encode(pack("H*", sha1(utf8_encode($password))));
}

function verifyCookie($db, $rirection)
{

    if (isset($_COOKIE['w-login']) && $_COOKIE['w-login'] == true and isset($_COOKIE['w-password']) && $_COOKIE['w-password'] == true) {

        if (verifyLoginAndPassword($db, inputProtec($_COOKIE['w-login']), inputProtec($_COOKIE['w-password'])) === false) {

            header("Refresh: 0;" . $rirection);
        }
    } else {

        header("Refresh: 0;" . $rirection);
    }
}
