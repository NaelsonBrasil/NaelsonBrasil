<?php


date_default_timezone_set('America/Sao_Paulo'); // Set your timezone
function displayFilteredTasks($tasksArray)
{

    $currentDate = date('d-m-Y');
    $row_hours2 = ['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30'];

    $date_free = array();
    $f_tasks = array();

    foreach ($tasksArray['tasks'] as $task) {

        $taskDate = new DateTime($task['date']);
        $taskTime = new DateTime($task['hour']);
        $exeption = explode(":",  $taskTime->format('H:i'));

        if ($taskTime->format('H:i') >= '10:00' && $taskTime->format('H:i') <= '20:00' && $exeption[0] != 13) {
            $f_tasks[] = array(
                'hour' => $task['hour'],
                'date' => $taskDate->format('d-m-Y'),
            );
        }
    }

    $arys_ax = array();
    for ($i = 0; $i < 3; $i++) {
        $nowdy_date = null;
        $row_hours = ['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30'];
        $nowdy_date = date('d-m-Y', strtotime('+' . ($i + 1) . ' day'));
        $count = 0;
        for ($j = 0; $j < count($f_tasks); $j++) {
            if ($f_tasks[$j]['date'] == $nowdy_date) {
                $arys_ax[$nowdy_date][$count]['date'] = $nowdy_date;
                $arys_ax[$nowdy_date][$count]['hour'] = $f_tasks[$j]['hour'];
                $count++;
            }
        }

        if (count($tasksArray['tasks']) <= 0) {
            $currentDate = date('d-m-Y');
            for ($i = 0; $i < 3; $i++) {
                $nextDate = date('d-m-Y', strtotime($currentDate . ' + ' . ($i + 1) . ' day'));
                $date_free['data_disponivel']['dia_' . ($i + 1)]['data'] = $nextDate;
                $date_free['data_disponivel']['dia_' . ($i + 1)]['horas'] = $row_hours;
            }

            return $date_free;
        }

        if (isset($arys_ax[$nowdy_date]) && count($arys_ax[$nowdy_date]) > 0) {

            $count_task = count($arys_ax[$nowdy_date]);
            
            if ($count_task > 0) {
                for ($k = 0; $k < $count_task; $k++) {
                    $row_hours = array_diff($row_hours, [$arys_ax[$nowdy_date][$k]['hour']]);
                }
            }

            uksort($row_hours, function ($a, $b) {
                return $a - $b;
            });

            // if ($nowdy_date == "04-03-2024") {
            //     return $row_hours;
            //     exit;
            // }

            //  file_put_contents('dump_' . $i . ' ' . $nowdy_date . '.txt', print_r($row_hours, TRUE));

            // $dateString = $nowdy_date;
            // $dateTime = DateTime::createFromFormat('d-m-Y', $dateString);
            // $englishDate = $dateTime->format('Y-m-d');

            $reindexed_array = array_values($row_hours);
            $date_free['data_disponivel']['dia_' . ($i + 1)]['data'] = $nowdy_date;
            $date_free['data_disponivel']['dia_' . ($i + 1)]['horas'] = $reindexed_array;

            // for ($t = 0; $t < count($reindexed_array); $t++) {
            //     if ($reindexed_array[$t] > $currentHour) {
            //         return array('data_livre' => $nowdy_date, 'hora' => $reindexed_array[$t]);
            //     } else if (strtotime($currentDate) < strtotime($englishDate)) {
            //         return array('data_livre' => $nowdy_date, 'hora' => $reindexed_array[0]);
            //     }
            // }

            //

            //


        } else if (!isset($arys_ax[$nowdy_date])) {
            $date_free['data_disponivel']['dia_' . ($i + 1)]['data'] = $nowdy_date;
            $date_free['data_disponivel']['dia_' . ($i + 1)]['horas'] = $row_hours2;
        }

        //
    }

    // $count_data = count($date_free['data_disponivel']);
    // $times = 3;
    // if ($count_data < $times) {

    //     $currentDate = date('d-m-Y');
    //     $times = ($times - $count_data);
    //     for ($i = $count_data + 1; $i < 3 + 1; $i++) {
    //         $nextDate = date('d-m-Y', strtotime($currentDate . ' + ' . ($i - 1) . ' day'));
    //         $date_free['data_disponivel']['dia_' . ($i)]['data'] = $nextDate;
    //         $date_free['data_disponivel']['dia_' . ($i)]['horas'] = $row_hours2;
    //     }

    //     return $date_free;
    // } else {
    //     return $date_free;
    // }

    return $date_free;
}

function logMessage($message, $logFile = 'log.txt')
{
    // Get the current date and time
    $timestamp = date('Y-m-d H:i:s');

    // Format the log entry
    $logEntry = "[$timestamp] $message" . PHP_EOL;

    // Append the log entry to the log file
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Recebe o JSON do corpo da requisição POST
$json = file_get_contents('php://input');

// Decodifica o JSON recebido
$playload = json_decode($json, true);

$agentToken = $playload['agentToken'];
$agentID = $playload['agentID'];

// Get current date
$current_date = date('Y-m-d', strtotime('+1 day'));

// sabado e domingo
// Get next day's date
$nowdy_date = date('Y-m-d', strtotime('+3 day'));

$cUrl_check = curl_init();
curl_setopt_array($cUrl_check, array(
    CURLOPT_URL => 'https://crm.rdstation.com/api/v1/tasks?token=' . $agentToken . '&user_id=' . $agentID . '&date_start=' . $current_date . '&date_end=' . $nowdy_date,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'accept' => 'application/json',
    ),
));

$response = curl_exec($cUrl_check);
if ($response === false) {
    logMessage('cURL error: ' . ' LINE: ' . __LINE__, 'error.txt');
}
curl_close($cUrl_check);
$check_task_rdstation = json_decode($response, true);


function loadJsonFromFile($filename)
{
    // Check if the file exists
    if (file_exists($filename)) {
        // Read the content from the file
        $jsonContent = file_get_contents($filename);

        // Decode JSON content
        $data = json_decode($jsonContent, true);

        // Check if decoding was successful
        if ($data !== null) {
            return $data;
        } else {
            // Handle decoding error
            echo 'Error decoding JSON';
        }
    } else {
        // Handle file not found error
        echo 'File not found';
    }

    return null;
}

// Usage example
// $filename = 'data.json';
// $loadedData = loadJsonFromFile($filename);

// Display the loaded data

// Call the function
echo json_encode(displayFilteredTasks($check_task_rdstation));
