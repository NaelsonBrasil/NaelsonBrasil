<?php
session_start();
require 'Paypal.php';

if (isset($_GET['paymentId']) and isset($_GET['PayerID']) and isset($_GET['token'])) {

        $callPaypal = new Paypal();
    if ($callPaypal->completed($_SESSION["id"], $_GET['paymentId'], $_GET['PayerID'], $_GET['token']) === true) {
        header('Location: ' . $baseUrl . 'orders');
    }
    
}
