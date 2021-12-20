<?php
function createAccount($name, $email, $password)
{

    $dbc = new DbConnect();

    if (!empty($name) and !empty($email) and !empty($password)) {

        $inName = inputProtec($name);
        $inEmail = inputProtec($email);
        $inPassword = inputProtec($password);
        $inStatus = 'active';
        $inVip = NULL;
        $inLogin = NULL;
        $inLogount = NULL;
        $inCoupon = NULL;
        $inAcessLevel = 0;

        if (verifyData('account', 'name', $inName) == 0) {

            if (verifyData('account', 'email',  $inEmail) == 0) {

                $arrayData = array(
                    'name' => $inName,
                    'email' => $inEmail,
                    'password' => password_hash($inPassword, PASSWORD_DEFAULT),
                    'data_create' => date("Y-m-d H:i:s"),
                    'status' => $inStatus,
                    'vip' => $inVip,
                    'login' => $inLogin,
                    'logout' => $inLogount,
                    'coupon' => $inCoupon,
                    'access_level' => $inAcessLevel
                );

                $run = $dbc->conn->prepare('INSERT INTO account (name,email,password,data_create,status,vip,login,logout,coupon,access_level) VALUES(:name,:email,:password,:data_create,:status,:vip,:login,:logout,:coupon,:access_level)');

                $run->execute($arrayData);
                $run->rowCount();

 
                $_SESSION['register_error_msg'] = "Registred with success";
                $_SESSION['register_success'] = true;
                header('Location: ' . BASE_URL . 'pag/register');

            } else if (verifyData('account', 'email',  $inEmail) == 1)

            $_SESSION['register_error_msg'] = "Email unavailable";
            $_SESSION['register_error'] = true;
            header('Location: ' . BASE_URL . 'pag/register');

        } else if (verifyData('account', 'name',  $inName) == 1)

        $_SESSION['register_error_msg'] = "Login name unavailable";
        $_SESSION['register_error'] = true;
        header('Location: ' . BASE_URL . 'pag/register');

    } else {

        $_SESSION['register_error_msg'] = "Empty";
        $_SESSION['register_error'] = true;
        header('Location: ' . BASE_URL . 'pag/register');

    }
}
