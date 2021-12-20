<?php


//=============Url base,dir =================

$dbDirectory = dirname(__FILE__); //folder current
$baseDir = getcwd(); //folder application

$adminDirectory = '';

for ($i = 0; $i < strlen($dbDirectory); $i++) {

    $adminDirectory .= $dbDirectory[$i];
    if (@$dbDirectory[$i + 3] == null) {

        if (@$dbDirectory[$i + 1] . @$dbDirectory[$i + 2] == 'db')
            break;
    }
}

$baseApp = '';
$key = NULL;

for ($i = 0; $i < strlen($baseDir); $i++) {

    if (@$baseDir[$i + 1] . @$baseDir[$i + 2] . @$baseDir[$i + 3] == 'app') {

        if ($key == null) $key = $i;

        $resize = strlen($baseDir) -  $i;

        for ($j = 0; $j < $resize; $j++) {

            if ($key == NULL) echo "Error";

            else if ($key > 0) {

                $key += 1;

                $baseApp .= $baseDir[$key];
                if (@$baseDir[$key + 1] == null) break;
            }
        }
    }
}

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url = ''; //current url

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



//=============Include dasboard=================
require $adminDirectory . '/config/config.php';
require_once $adminDirectory . 'admin/DbConnect.php';
require $adminDirectory . 'admin/vendor/autoload.php';

use \Firebase\JWT\JWT;

//=============Get Text=================
if (!function_exists('getDataConfig')) {

    //Autor Naelson.g.saraiva@gmail.com
    //06/2019

    // ignore line empty ignore 2e90f67
    // ignore Spaces in line empty ignore 4ba320f
    // ignore Two bar ignore

    //"\n"
    //"\r" 
    //" "
    function getDataConfig($dir, $nameFileDefined, $system): array
    {
        $fileName = $dir . $nameFileDefined;

        $arrayString = array();
        $helpArray = array(); //Clean arrayString

        if (file_exists($fileName)) {

            $handle = fopen($fileName, "r");

            $lines = 0;
            while (!feof($handle)) {

                $string = fgets($handle);
                $arrayString[$lines] = $string;
                $lines = $lines  + 1;
            }

            fclose($handle);

            switch ($system) {

                case 'linux':
                    $size = count($arrayString);

                    $n = 0;
                    for ($i1 = 0; $i1 < $size; $i1++) {

                        if ($arrayString[$i1][0] != "\n") { // space empty elimine 

                            for ($j = 0; $j < strlen($arrayString[$i1]); $j++) {

                                if ($arrayString[$i1][$j] == "\n") {

                                    $n = $n + 1;
                                    break;
                                }

                                $helpArray[$n][$j] = $arrayString[$i1][$j];
                            }
                        }
                    }
                    break;

                case 'windows':
                    //Load Windows
                    $size = count($arrayString);

                    $n = 0;
                    for ($i1 = 0; $i1 < $size; $i1++) {

                        if ($arrayString[$i1][0] != "\r") { // space empty elimine 

                            for ($j = 0; $j < strlen($arrayString[$i1]); $j++) {

                                if ($arrayString[$i1][$j] == "\r") {

                                    $n = $n + 1;
                                    break;
                                }

                                $helpArray[$n][$j] = $arrayString[$i1][$j];
                            }
                        }
                    }
               break;
            }

            $endArray1 = array();
            $infinity1 = 1;
            $n2 = 0;

            for ($i = 0; $i < count($helpArray); $i++) {

                for ($j = 0; $j < $infinity1; $j++) {

                    $infinity1++;

                    //Protection control flood lines
                    if ($infinity1 > 10000) {
                        error_log(" error lengh string in the line infinity1 " . date("Y-m-d H:i:s") . "\n", 3, "fread.log");
                        break;
                    }

                    if ($helpArray[$i][0] == "#" || $helpArray[$i][0] == "/") break;

                    if (isset($helpArray[$i][$j + 1]) == NULL) {

                        for ($k = 0; $k < $j + 1; $k++)

                            $endArray1[$n2][$k] = $helpArray[$i][$k];

                        $n2 = $n2 + 1;
                        break;
                    }
                }
            }

            $endArray2 = array();
            $infinity2 = 1;
            $n3 = 0;
            for ($i = 0; $i < count($endArray1); $i++) {

                for ($j = 0; $j < $infinity2; $j++) {

                    $infinity2++;
                    //Protection control flood lines
                    if ($infinity2 > 10000) {
                        error_log(" error lengh string in the line infinity2 " . date("Y-m-d H:i:s") . "\n", 3, "fread.log");
                        break;
                    }


                    if ($endArray1[$i][0] == " ") break;

                    if (isset($endArray1[$i][$j + 1]) == NULL) {

                        for ($k = 0; $k < $j + 1; $k++)

                            $endArray2[$n3][$k] = $endArray1[$i][$k];

                        $n3 = $n3 + 1;
                        break;
                    }
                }
            }

            if (count($endArray2) == 0) {

                error_log(" This " . $fileName . " is empty! " . date("Y-m-d H:i:s") . "\n", 3, $dir . "fread.log");
            } else {

                //Where you can work your code evolution!
                $myData = array();
                $myKey = array();

                $infinity3 = 1;

                for ($i = 0; $i < count($endArray2); $i++) {

                    for ($j = 0; $j < $infinity3; $j++) {

                        $infinity3++;

                        //Protection control flood lines
                        if ($infinity3 > 10000) {
                            error_log(" error lengh string in the line infinity3 " . date("Y-m-d H:i:s") . "\n", 3, "fread.log");
                            break;
                        }

                        if ($endArray2[$i][$j] != "=") {

                            @$index .= $endArray2[$i][$j];

                            if ($endArray2[$i][$j + 1] == "=") {

                                $myKey[$i] = $index;
                                $myData[$index] = 0;
                                unset($index);

                                break;
                            }
                        }
                    }
                }

                $active = false;
                $infinity4 = 1;
                for ($i = 0; $i < count($endArray2); $i++) {

                    for ($j = 0; $j < $infinity4; $j++) {

                        $infinity4++;
                        //Protection control flood lines
                        if ($infinity4 > 10000) {
                            error_log(" error lengh string in the line infinity4 " . date("Y-m-d H:i:s") . "\n", 3, "fread.log");
                            break;
                        }

                        if (@$endArray2[$i][$j - 1] == "{") $active = true;


                        if ($active === true) @$value .= $endArray2[$i][$j];

                        if ($endArray2[$i][$j + 1] == "}") {

                            $myData[$myKey[$i]] = @$value;
                            unset($value);
                            unset($infinity4);

                            $active = false;
                            break;
                        }
                    }
                }
            }
        } else {

            error_log(" the file " . $fileName . "does not exist!" . date("Y-m-d H:i:s") . "\n", 3, $dir . "fread.log");
        }

        return  $myData;
    }
}

if (!function_exists('inputProtect')) {

    function inputProtect($str): string
    {
        $spaceRemove = preg_replace('/\s+/', '', $str);
        return addslashes(strip_tags(trim(htmlspecialchars($spaceRemove))));
    }
}
