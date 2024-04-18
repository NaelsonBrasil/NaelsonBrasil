<?php

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
$data = json_decode($json, true);
file_put_contents('dump_data.txt', print_r($data, TRUE));

$playload = $data['data']['payload']['contact'];
$name = $data['data']['payload']['contact']['name'];
$number = $data['data']['payload']['contact']['number'];
$user_id = $data['data']['payload']['user']['id'];

$ch = curl_init('https://xxxxxxxxxxxxxxxxxxxxxx.onecode.chat/api/users/' . $user_id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer xxxxxxxxxxxxxxxxxxxxxxx',
]);

$response = curl_exec($ch);
if ($response === false) logMessage('cURL error: ' . ' LINE: ' . __LINE__, 'error.txt');
curl_close($ch);
$oneCodeUser = json_decode($response, true);

$ch = curl_init('https://crm.rdstation.com/api/v1/users?token=xxxxxxxxxxxx');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
]);

$response = curl_exec($ch);
if ($response === false) logMessage('cURL error: ' . ' LINE: ' . __LINE__, 'error.txt');
curl_close($ch);

$rdStationUser = json_decode($response, true);
$rdStationUserID = null;
if (isset($rdStationUser['users']) && count($rdStationUser['users']) > 0) {
    foreach ($rdStationUser['users'] as $key => $item) {
        if ($item['email'] == $oneCodeUser['email']) {
            $rdStationUserID = $item['id'];
        }
    }
}

// Load the contents of keys.json file
$jsonFile = 'keys.json';
$filePath = __DIR__ . '/' . $jsonFile;

// Check if the file exists
if (!file_exists($filePath)) {
    logMessage('Arquivo não existe ' . ' LINE: ' . __LINE__, 'error.txt');
}
$jsonData = file_get_contents($jsonFile);

// Decode JSON data
$data = json_decode($jsonData, true);

$key_token = null;
$email_toMatch = $data_r['data']['email'];
foreach ($data['data'] as $index => $row) {
    if ($row['email'] === $oneCodeUser['email']) {
        $key_token = $row['key'];
        break;
    }
}

// logMessage('It is an user:' . $number . ' Nome:' . $name . ' Email: ' . $oneCodeUser['email'] . ' IRD: ' . $rdStationUserID, 'EverUser.txt');
// file_put_contents('received_json.txt', $rdStationUserID);

if (empty($number) == false and empty($name) == false and empty($oneCodeUser['email']) == false and empty($rdStationUserID) == false) {

    // Step 2: Simulação - Consulta de saldo disponível (GET)
    $cUrl_check = curl_init();
    curl_setopt_array($cUrl_check, array(
        CURLOPT_URL => 'https://crm.rdstation.com/api/v1/contacts?token=xxxxxxxxxxxx&phone=' . $number,
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
    if ($response === false) logMessage('cURL error: ' . ' LINE: ' . __LINE__, 'error.txt');
    curl_close($cUrl_check);
    $check_user_rdstation = json_decode($response, true);

    file_put_contents('key_check.txt', $key_token);
    // exit;

    if (isset($check_user_rdstation['total']) && $check_user_rdstation['total'] == 0) {

        $data_array = [
            'deal' => [
                'deal_stage_id' => '659d4a0f3883a5000deabe6c',
                'name' => $number
            ],
            'distribution_settings' => [
                'owner' => [
                    'type' => 'team',
                    'id' => $rdStationUserID
                ]
            ],
            'contacts' => [
                [
                    'name' => $name,
                    'phones' => [
                        ['phone' => $number]
                    ]
                ]
            ]
        ];

        $body = json_encode($data_array);
        $ch_insert = curl_init('https://crm.rdstation.com/api/v1/deals?token=' . $key_token);
        curl_setopt($ch_insert, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch_insert, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
        ]);
        curl_setopt($ch_insert, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch_insert, CURLOPT_CUSTOMREQUEST, 'POST');

        $response = curl_exec($ch_insert);
        if ($response === false) logMessage('cURL error: ' . ' LINE: ' . __LINE__, 'error.txt');
        curl_close($ch_insert);

        $rdStationInsert = json_decode($response, true);
        if (isset($rdStationInsert['error'])) {
            logMessage('error Numero:' . $number . ' Nome:' . $name . ' LINE: ' . __LINE__, 'error.txt');
        } else {
            logMessage('criado: Numero:' . $number . ' Nome:' . $name . ' para: ' . $oneCodeUser['email'] . ' LINE: ' . __LINE__, 'success.txt');
        }

        //
    } else {
        logMessage('contato existente no rdstation: Numero:' . $number . ' Nome:' . $name . ' para: ' . $oneCodeUser['email'] . ' LINE: ' .  __LINE__, '_exist.txt');
    }
}
