<?php
// Load the contents of keys.json file
$jsonFile = 'keys.json';
$filePath = __DIR__ . '/' . $jsonFile;

// Check if the file exists
if (!file_exists($filePath)) {
    logMessage('Arquivo não existe ' . ' LINE: ' . __LINE__, 'error.txt');
}

$jsonFile = 'keys.json';
$jsonData = file_get_contents($jsonFile);

// Decode JSON data
$data = json_decode($jsonData, true);

echo json_encode($data['data']);
