<?php require 'crud/read.php'; ?>
<?php require 'Paypal.php'; ?>
<?php 


############################################################################################ [BEGIN] PAYPAL
if(isset($_POST['order']) and isset($_POST['form_paypal'])) {

    //DEBUG
    // echo getAllOrder($_POST['order'])[0]['price'];
    // echo getAllOrder($_POST['order'])[0]['dyas'];
    // echo getAllOrder($_POST['order'])[0]['num_order'];
    // echo getAllOrder($_POST['order'])[0]['site_name'];

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AcTp_kzrzo77Hy-qrxSSaO1EsadOgO69WHUArSkqT50lZo4aD7CeID7oKxxnszItxZ7Hl0GWhnmMcGh6',  // ClientID
            'EBRmHs1YGVLKxh9sC45ChALnrGofLJrIIs27Kz-HIXBIxJN-OelnHfEvm8M03uuQHPFWAr4LDFp9sa1Z'  // ClientSecret
        )
    );

    echo $adminUrl."completed";

    $callPaypal = new Paypal();
    Paypal::initialize($apiContext,$adminUrl."completed.php",$adminUrl."canceled.php",getAllOrder($_POST['order'])[0]['site_name'],"BRL",1,getAllOrder($_POST['order'])[0]['num_order'],getAllOrder($_POST['order'])[0]['price'],getAllOrder($_POST['order'])[0]['price']);

}


//END