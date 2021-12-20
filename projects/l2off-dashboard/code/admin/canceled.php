<?php
session_start();
require_once 'DbConnect.php';
require 'crud/insert.php';
require '../tools.php';

if (isset($_GET['token']) and !empty($_GET['token'])) {
    $db = new DbConnect();
    if (whoCanceled($db, $_SESSION["id"], getRealIpAddr(), $_GET['token'], date("Y-m-d H:i:s")) === true) {
        header('Location: ' . $baseUrl . 'orders');
    }else {
        echo "error";
    }
}
