<?php
require 'config.php';

class DbConnect
{
    public $conn;
    private $attrIp;
    private $attrDb;
    private $user;
    private $password;
    private $charset;

    function __construct()
    {
        $this->getDataConn(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHARSET); //Load config
        $dsn = "mysql:host=$this->attrIp;dbname=$this->attrDb;charset=$this->charset"; // Define DNS

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->conn = new PDO($dsn, $this->user, $this->password, $options); // Set DNS data USER and ATTR
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    private function getDataConn($pIp, $pDb, $pUser, $pPw, $pCharSet)
    {
        $this->attrIp = $pIp;
        $this->attrDb = $pDb;
        $this->user = $pUser;
        $this->password = $pPw;
        $this->charset = $pCharSet;
    }


    // Insert History
    /**
     *  user id
     *  produtc id
     *  quantity
     *  price
     *  data aproved
     *  method payment utilited
     *  payment of paypal method paypal
     *  token of paypal method paypal
     *  playerid of paypal method
     * @since 0.0.0
     *
     * @param return false or true
     */
    public function historyPayment($id_user, $id_product, $amount, $price, $data, $method, $paymentId, $token, $PayerID)
    {

        $data = array(
            'id_user' => $id_user,
            'id_product' => $id_product,
            'amount' => $amount,
            'price' => $price,
            'data' => $data,
            'method' => $method,
            'payment_id' => $paymentId,
            'token_retorned' => $token,
            'payer_id' => $PayerID
        );

        try {

            $sql = "INSERT INTO history_payment (id_user,id_product,amount,price,data,method,payment_id,token_retorned,payer_id) Value (:id_user,:id_product,:amount,:price,:data,:method,:payment_id,:token_retorned,:payer_id)";
            $run = $this->conn->prepare($sql);
            $run->execute($data);

            return true;

        } catch (PDOException $e) {

            return false;
            
        }
    }

    /**
     * Development Naelson.g.saraiva@gmail.com
     * @param order
     * @param status
     * @param data_proved
     * @param return true or false
     */
    function updateStatusOrder($order, $status, $data): bool
    {
        $run = $this->conn->prepare("UPDATE orders SET status = '$status', data_approved = '$data' WHERE num_order = '$order' ");
        return $run->execute();
    }
}
