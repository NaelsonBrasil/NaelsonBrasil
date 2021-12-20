<?php

//Pag origin not can has exist number
//By Naelson.g.saraiva@gmail.com 
function getFileNameDirectory($directory, $directDestiny): array
{

    $origin = array();
    $dstHelp = array();

    for ($n = 0; $n < count($directory); $n++) {

        $myFilesNameMain = array(); // Directory index
        $nFilesMain = array(); // Directory index


        $i = 0;
        foreach (glob($directory[$n] . '/*.*') as $file) { // get all file name in directory x

            $nFilesMain[$i] = $file;

            $nBar = count(explode("/", $nFilesMain[$i])) - 1; // Remove - 1

            $xBar = 0;
            $key = 0;
            for ($j = 0; $j < strlen($nFilesMain[$i]); $j++) {

                if ($nFilesMain[$i][$j] == '/') $xBar += 1;

                if ($xBar == $nBar) {
                    $key =  $j;
                    break;
                }
            }

            // Issue with ZERO
            // 75d79a7252b5a2e62d0b283bb337345a.txt
            // 75d79a7252b5a2e62d0
            /*                 for ($k = 0; $k < strlen($nFilesMain[$i]) - $key;) {
                        $k++;

                        if (!@$nFilesMain[$i][$key + $k] == NULL)
                            @$myFilesNameMain[$i] .= $nFilesMain[$i][$key + $k];
                        else
                            break;
                    }

                    $i += 1;
                } 
    */

            for ($k = 0; $k < strlen($nFilesMain[$i]) - $key;) {

                $k++;

                if (!isset($nFilesMain[$i][$key + $k]) == NULL) {

                    @$myFilesNameMain[$i] .= $nFilesMain[$i][$key + $k];
                } else {
                    break;
                }
            }

            $i += 1;
        }

        for ($n2 = 0; $n2 < count($myFilesNameMain); $n2++) {

            $dstHelp[$n][$n2] = $myFilesNameMain[$n2]; // For destiny
            $origin[$n][$n2] = $directory[$n] . '/' . $myFilesNameMain[$n2];
        }
    }

    //Folder destiny
    $destiny = array();
    if (count($dstHelp) == count($directDestiny)) {

        for ($i = 0; $i < count($dstHelp); $i++) {

            $infinity = 1;
            for ($j = 0; $j < $infinity; $j++) {

                $infinity++;

                if (@$dstHelp[$i][$j] != NULL) {

                    $destiny[$i][$j] = $directDestiny[$i] . '/' . $dstHelp[$i][$j];
                } else {

                    break;
                }
            }
        }
    } else {

        echo "Error ogirin and destiny different";
    }

    return array('origin' => $origin, 'destiny' => $destiny);
}

function copyBaseIndex($origin, $destiny, $urlOriginalFileName, $originalFileName, $fileNameModifield)
{
    if (count($origin) == count($destiny)) {

        for ($i = 0; $i < count($origin); $i++) {

            for ($j = 0; $j < count($origin[$i]); $j++) {

                //step 2
                if (copy($origin[$i][$j], $destiny[$i][$j]) === false) {

                    return false;

                } else {
                    
                    //step 3
                    if ($i + 1 == count($origin) and isset($destiny[$i][$j + 1]) == NULL) { //run last arrays element

                        //step 4
                        if (rename($urlOriginalFileName . $fileNameModifield, $urlOriginalFileName . $originalFileName) === true) {
                            
                 
                            return  true;

                        } else {

                            return false;

                        }
                    }
                }
            }
        }
    } else {

        return false;
    }
}

function startDataTemp($wNameId, $plan, $days, $status)
{
    //Add one the more
    $end = date('Y-m-d', strtotime('+' . $days . 'days'));
    $begin = date('Y-m-d');
    tempDuraction($wNameId, $days, $begin, $end, $plan, $status);
}