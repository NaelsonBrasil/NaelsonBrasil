<?php
require_once '../tools.php';
require 'crud/read.php';
require 'crud/delete.php';

require directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'config/config.php';
require 'vendor/autoload.php';

use \Firebase\JWT\JWT;

if ($product == 'production') {

    error_reporting(0);
} else if ($product == 'development') {

    error_reporting(1);
}

$fileConfigName = array();
require  directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'db/Mysql.php';
require  directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'db/administrator.php';

$sizeWB = getAllWebNameById($_SESSION['id']);
$myWN = getAllWebNameById($_SESSION['id'])[0]['name'];
$myTK = getAllWebNameById($_SESSION['id'])[0]['token'];
$dirRoot = directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . "app/template/" . $myWN . "/";

if (count($sizeWB) > 0) {

    if (file_exists($dirRoot . $myTK . ".txt") === true) {
        $myData = getDataConfig($dirRoot, $myTK . '.txt', SYSTEM_OPRATIONAL);
    }
}

function getTotalViews($wbn): int
{
    if (!empty($wbn)) {

        $totalViews = getTotalVisits($wbn);

        if ($totalViews == 2) {

            return $totalViews - 1;
        } else if ($totalViews >= 4) {

            return getTotalVisits($wbn) / 2;
        } elseif ($totalViews == 0) {

            return 0;
        }
    } else {

        return 0;
    }
}

function DisplayPaidOut()
{

    $count = 0;
    $size = count(getAllTempWebFreeOne());
    for ($i = 0; $i < $size; $i++) {

        $free = getAllTempWebFreeOne()[$i]['free'];
        $end_data = getAllTempWebFreeOne()[$i]['end_data'];
        $less_data = strtotime(date('Y-m-d', strtotime($end_data . ' + 3 days')));
        $current = strtotime(date('Y-m-d'));

        if ($current >= $less_data and $free == 1) {
            $count += 1;
        }
    }

    return $count;
}

function DisplayFree()
{
    $count = 0;
    $size = count(getAllTempWebFreeZero());
    for ($i = 0; $i < $size; $i++) {

        $free = getAllTempWebFreeZero()[$i]['free'];
        $end_data = getAllTempWebFreeZero()[$i]['end_data'];
        $old_data = strtotime($end_data);
        $current = strtotime(date('Y-m-d'));

        if ($current >= $old_data and $free == 0) {
            $count += 1;
        }
    }

    return $count;
}


function delete_directory($dirname)
{
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while ($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname . "/" . $file))
                unlink($dirname . "/" . $file);
            else
                delete_directory($dirname . '/' . $file);
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}

function deleteFree($dir)
{

    $current_data = date('Y-m-d');
    $size = count(get_id_name_all_expired_free($current_data)); //step 1 get web_name_id

    for ($i = 0; $i < $size; $i++) {

        $id_wbn = get_id_name_all_expired_free($current_data)[$i]['web_name_id'];

        $w_b_n =  get_web_name_by_id($id_wbn); //step 2 with id web_name_id get name

        if (!empty($w_b_n)) {

            //setp 3 delete and return true or false
            if (delete_directory($dir . $w_b_n) === true) {

                if (delete_all_web_name($id_wbn) === true) {

                    if (delete_all_temp($id_wbn) === true) {

                        return true;
                    } else return 'error step 3';
                } else return 'error step 2';
            } else return 'error step 1';
        } else {
            error_log("Error empty webname" . date("Y-m-d H:i:s") . "\n", 3, "delete_webnames.log");
        }
    }
}

function deletePaid($dir)
{
    
    $current_data = date('Y-m-d');
    $size = count(get_id_name_all_expired_paid($current_data)); //step 1 get web_name_id

    for ($i = 0; $i < $size; $i++) {

        $id_wbn = get_id_name_all_expired_paid($current_data)[$i]['web_name_id'];

        $w_b_n =  get_web_name_by_id($id_wbn); //step 2 with id web_name_id get name

        if (!empty($w_b_n)) {
            //setp 3 delete and return true or false
            if (delete_directory($dir . $w_b_n) === true) {

                if (delete_all_web_name($id_wbn) === true) {

                    if (delete_all_temp($id_wbn) === true) {

                        return true;
                    } else return 'error step 3';
                } else return 'error step 2';
            } else return 'error step 1';
        } else {
            error_log("Error empty webname" . date("Y-m-d H:i:s") . "\n", 3, "delete_webnames.log");
        }
    }
}

//Development and modifield Naelson.g.saraiva@gmail.com
function uploadFileConfig($files, $dirR, $fileNameEncrypted)
{

    $changeByOriginalName = $fileNameEncrypted . ".txt"; //Change by original name that's stored in database
    $uploadFile = $dirR . basename($changeByOriginalName); //Get name wihout the directory
    if(move_uploaded_file($files['upload']['tmp_name'], $uploadFile) != false ) //Upload for back end
       header('Location: ' . BASE_URL);
}

function getConnectionStatus($folderName)
{
    if (isset($folderName)) {

        if (file_exists(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $folderName . '/baseDBConfig.ini') === true) {

            $iniTemplate = directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__), SYSTEM_OPRATIONAL) . 'app/template/' . $folderName . '/baseDBConfig.ini';
            $config = parse_ini_file($iniTemplate);

            $dbSrv = new Mysql($config['ip'], $config['user'], $config['pass'], $config['db'], $config['port']);

            if ($dbSrv->error === true) {

                return false;
                $dbSrv->conn->close();
            } else {

                return true;
                $dbSrv->conn->close();
            }
        } else {

            return false;
        }
    } else {

        return false;
    }
}
