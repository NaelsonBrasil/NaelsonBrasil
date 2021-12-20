<?php
require 'vendor/autoload.php';
require_once 'DbConnect.php';

class Paypal extends DbConnect
{

    public $configKey = array(
        'paypalClientId' => 'AcTp_kzrzo77Hy-qrxSSaO1EsadOgO69WHUArSkqT50lZo4aD7CeID7oKxxnszItxZ7Hl0GWhnmMcGh6',
        'paypalClientSecret' => 'EBRmHs1YGVLKxh9sC45ChALnrGofLJrIIs27Kz-HIXBIxJN-OelnHfEvm8M03uuQHPFWAr4LDFp9sa1Z'
    );

    function __construct()
    {
        parent::__construct();
    }

    public static function initialize($apiContext, $urlCompleted, $urlCancel, $itemName, $currency, $quantity, $itemId, $price, $subtotal)
    {
        //$qt = $quantity - $bonus;

        $payer = new \PayPal\Api\Payer();
        $item = new \PayPal\Api\Item();
        $itemList = new \PayPal\Api\ItemList();
        $details = new \PayPal\Api\Details();
        $amount = new \PayPal\Api\Amount();
        $transaction = new \PayPal\Api\Transaction();
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $payment = new \PayPal\Api\Payment();

        self::setMethod($payer);
        self::item($item, $itemList, $itemName, $currency, $quantity, $itemId, $price);
        self::amount($amount, $details, $currency, $subtotal);
        self::transaction($transaction, $amount, $itemList);
        self::redirect($redirectUrls, $urlCompleted, $urlCancel);
        self::payment($payment, $payer, $transaction, $redirectUrls);
        self::create($payment, $apiContext);
    }

    protected static function setMethod($player)
    {
        $player->setPaymentMethod('paypal');
    }

    protected static function redirect($redirect, $urlCompleted, $urlCancel)
    {
        $redirect->setReturnUrl($urlCompleted);
        $redirect->setCancelUrl($urlCancel);
    }

    protected static function item($item, $itemList, $itemName, $currency, $quantity, $itemId, $price)
    {

        $item->setName($itemName)
            ->setCurrency($currency)
            ->setQuantity($quantity)
            ->setSku($itemId) // Similar to `item_number` in Classic API
            ->setPrice($price);

        $itemList->setItems(array($item));
    }

    protected static function amount($amount, $details, $currency, $subtotal)
    {

        $details->setSubtotal($subtotal);
        $amount->setTotal($subtotal)
            ->setCurrency($currency)
            ->setDetails($details);
    }

    protected static function transaction($transaction, $amount, $itemList)
    {
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
    }

    protected static function payment($payment, $payer, $transaction, $redirectUrls)
    {
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
    }

    protected static function create($payment, $apiContext)
    {
        try {
            $payment->create($apiContext);

            //            echo $payment;
            //            $json = file_get_contents($payment);
            //            $obj = json_decode($json);
            //            echo $obj->access_token;

            header("Location: " . $payment->getApprovalLink());

            //            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }


    /*
     * GET paymentId
     * GET PayerID
     */
    public function completed($sessionID, $paymentId, $playerId, $token): bool
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->configKey['paypalClientId'], // ClientID
                $this->configKey['paypalClientSecret'] // ClientSecret
            )
        );

        $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);

        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($playerId);

        try {

            $payment->execute($execution, $apiContext);

            try {

                $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
                $status = $payment->getState();
                $reponse = current($payment->getTransactions());
                $reponse = $reponse->toArray();

                if ($status == 'approved') {

                    //echo $reponse["amount"];
                    // echo '<pre>';
                    // print_r($reponse['item_list']['items'][0]['sku']);
                    // echo '</pre><br>';
                    // echo '<pre>';
                    // print_r($reponse);
                    // echo '</pre><br>';

                    $product_id = $reponse['item_list']['items'][0]['sku'];
                    $qt = $reponse['item_list']['items'][0]['quantity'];
                    $price = $reponse['item_list']['items'][0]['price'];

                    $this->historyPayment($sessionID, $product_id, $qt, $price, date("Y-m-d H:i:s"), "paypal", $paymentId, $token, $playerId);
                    $this->updateStatusOrder($product_id,"approved",date("Y-m-d H:i:s"));
                    
                    return true;

                } else {

                    echo "Exception, cancel payment. Contact support development API vipcriativo.web@gmail.com";
                    exit;
                }
            } catch (Exception $e) {

                echo "Exception, cancel payment. Contact support development API vipcriativo.web@gmail.com";
                exit;
            }
        } catch (Exception $e) {

            echo "Exception, cancel payment. Contact support development API vipcriativo.web@gmail.com";
            exit;
        }
    }
}
