<?php

$currentDate = date('Y-m-d');

$dateString = '01-03-2024';
$dateTime = DateTime::createFromFormat('d-m-Y', $dateString);
$englishDate = $dateTime->format('Y-m-d');

if (strtotime($currentDate) > strtotime($englishDate)) {
    echo "sim";
} else {
    echo "no";
}
exit;

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

$data_r = json_decode($jsonData, TRUE);
if (isset($data_r['action']) && $data_r['action'] == 'save') {
    file_put_contents('keys.json', $jsonData);
} else {

    // Load the contents of keys.json file
    $jsonFile = 'keys.json';
    $jsonData = file_get_contents($jsonFile);

    // Decode JSON data
    $data = json_decode($jsonData, true);

    // Email to search and delete
    $emailToDelete = $data_r['data']['email'];

    // Find the index of the email in the data array
    $indexToDelete = -1;
    foreach ($data['data'] as $index => $row) {
        if ($row['email'] === $emailToDelete) {
            $indexToDelete = $index;
            break;
        }
    }

    // If email found, remove the corresponding row
    if ($indexToDelete !== -1) {

        array_splice($data['data'], $indexToDelete, 1);

        // Encode the updated data back to JSON
        $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);

        // Save the updated data back to the keys.json file
        file_put_contents($jsonFile, $updatedJsonData);

        //
    } else {
        echo 'exeption';
    }
}
