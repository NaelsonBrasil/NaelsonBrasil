<?php
require 'crud/read.php';
require 'crud/insert.php';
require 'process_help.php'; //Before includes

$ip = getRealIpAddr();
$tokenClient = $_POST['token_user_recaptacha'];
$secretKeyRecaptcha = $global['secret_key_recaptcha'];

$getJ = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKeyRecaptcha&response=$tokenClient");
$json = json_decode($getJ);

/*
  Rules of order
  FIRST Template ID for check if is free or paid
  AFTER Create web name column with function createWebName and after get all collumn with getAllWebNameById
*/

if ($json->success === $global['recaptcha_enable']) {

    if (!empty($_POST['wName']) and !empty($_POST['tempID'])) {

        $wName = $_POST['wName']; // name web choosed
        $template = getAllDataTemplateById($_POST['tempID']); // get collumn template selected

        if (getCountWebName($_SESSION["id"]) <= 0) {

            switch ($template[0]['free']) {

                case 0:

                    //Create web name
                    createWebName($_SESSION["id"], $template[0]["id"], $wName, $template[0]["project"], date("Y-m-d H:i:s"), $ip, md5(mt_rand(1, 100000) * (rand(1, 100000) + rand(1, 1000) / rand(1, 100))));
                    $dbwName = getAllWebName();

                    $allDataWN = getAllWebNameById($_SESSION["id"]); // GET ALL COLLUNM  WEB NAME CREATED BY createWebName

                    //Add in config.ini
                    $arrayIni = array(
                        'product' => 'production',
                        'system' => 'linux',
                        'wbn' => $allDataWN[0]['name'],
                        'wtoken' => $allDataWN[0]['token']
                    );

                    $arrays = array(

                        "<IfModule mod_rewrite.c>",
                        "RewriteEngine On",
                        "RewriteRule ^index/?$ main.php",
                        "RewriteRule ^home/?$ main.php",
                        "RewriteRule ^connect/?$ connect.php",
                        "RewriteRule ^templates/?$ templates.php",
                        "RewriteRule ^freeBase?$ development/free/base/index.php",
                        "RewriteRule ^freeBuild?$ development/free/build/index.php"

                    );

                    $end_mod = "</IfModule>";
                    $originalFileName = 'baseConfig.txt';

                    //Change name original of file condig
                    rename(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category']  . '/' . $originalFileName, directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category']  . '/' . $allDataWN[0]['token'] . '.txt');

                    //Folder origin
                    $origin = array(

                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category'],
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category'] . '/crud',
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category'] . '/pags',
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category'] . '/css',
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category'] . '/js',
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category'] . '/css/images'

                    );

                    $destiny = array(

                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName,
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/crud',
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/pags',
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/css',
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/js',
                        directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/css/images'

                    );

                    //get directories for copie files origin e send for destiny
                    $filesDirectories = getFileNameDirectory($origin, $destiny);

                    //Debug all directories path and name
                    // echo "<pre>";
                    // print_r($filesDirectories);
                    // echo "</pre>";

                    $htaccess = count($arrays);
                    $countName = count($dbwName);

                    for ($i = 0; $i < $htaccess; $i++) {

                        if (isset($arrays[$i + 1]) == null) {

                            for ($j = 0; $j < $countName; $j++) {

                                $i = $i + 1;

                                $arrays[$i] = "RewriteRule ^" . $dbwName[$j]['name'] . "/?$ app/template/" . $dbwName[$j]['name'] . "/index.php";

                                if (isset($dbwName[$j + 1]) == null and  isset($arrays[$i + 1]) == null) {

                                    $arrays[$i + 1] = $end_mod;
                                    header('Location: ' . $adminUrl);

                                    break;
                                }
                            }
                        }
                    }

                    insert_with_markers('../.htaccess', 'rule', $arrays);

                    //Create folder for destiny find
                    mkdir(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName, 0777, true);
                    mkdir(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/pags', 0777, true);
                    mkdir(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/css', 0777, true);
                    mkdir(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/js', 0777, true);
                    mkdir(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/css/images', 0777, true);
                    mkdir(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $wName . '/crud', 0777, true);

                    //directory for add config.ini new
                    $dirConfig = directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category'] . '/baseDBConfig.ini';
                    $writeResponse = write_ini_file($dirConfig, $arrayIni);

                    //step 1
                    $success = copyBaseIndex($filesDirectories['origin'], $filesDirectories['destiny'], directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/free/' . $template[0]['project'] . '/' . $template[0]['category'] . '/', $originalFileName, $allDataWN[0]['token'] . '.txt');

                    //step 5
                    if ($success === true) {
                        startDataTemp($allDataWN[0]['id'], $template[0]["free"], 6, 'active');
                    }
                    break;

                case 1:

                    //DEBUG
                    // echo "<pre>";
                    // print_r($_POST);
                    // echo "</pre>";

                    if (empty(verifyOrder($_SESSION["id"]))) {

                        $rand_num = mt_rand(1, 100000);
                        $letter = substr(str_shuffle(str_repeat("abcdfghijklmnopqrstuvwzyz", 4)), 0, 4);
                        $newOrder = "v" . $rand_num . $letter . "-01";

                        if (order($_SESSION["id"], $_POST['tempID'], $_POST['wName'], $newOrder, getPriceTemplate($_POST['tempID']), getDyasTemplate($_POST['tempID']), 0, "pedding", date("Y-m-d H:i:s"), md5(mt_rand(1, 100000) * (rand(1, 100000) + rand(1, 1000) / rand(1, 100)))) === true) {

                            header('Location: ' . $adminUrl . 'orders');
                        } else {

                            $_SESSION['templates_error_msg'] = "Warning: Error to create order, contact support!";
                            $_SESSION['templates_error'] = true;
                            header('Location: ' . $indexUrl . 'templates');
                        }
                    } else if (verifyOrder($_SESSION["id"]) == "pedding" || verifyOrder($_SESSION["id"]) == "approved") {

                        header('Location: ' . $adminUrl . 'orders');
                    }

                    break;

                default:
                    break;
            }
        } else {

            $_SESSION['templates_error_msg'] = "Warning: already have website";
            $_SESSION['templates_error'] = true;
            header('Location: ' . $indexUrl . 'templates');
        }
    } else {

        $_SESSION['templates_error_msg'] = "Warning: empty";
        $_SESSION['templates_error'] = true;
        header('Location: ' . $indexUrl . 'templates');
    }
} else {

    $_SESSION['templates_error_msg'] = "Warning: recaptcha dectected";
    $_SESSION['templates_error'] = true;
    header('Location: ' . $indexUrl . 'templates');
}
