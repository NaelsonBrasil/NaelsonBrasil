<?php
//ADPTED JACIS

//CREATE RESPONSE
$response = array(
    "login" => array('error' => false, 'success' => false, 'msg' => ''),
    "register" => array('error' => false, 'success' => false, 'msg' => ''),
    "recover" => array('error' => false, 'success' => false, 'msg' => ''),
    "contact" => array('error' => false, 'success' => false, 'msg' => ''),
    "change_password" => array('error' => false, 'success' => false, 'msg' => ''),
    "unlock" => array('error' => false, 'success' => false, 'msg' => '')
);

$tokenClient = $_POST['token_user_recaptacha'];
$ip = getRealIpAddr();
$getJ = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKeyRecaptcha&response=$tokenClient&remoteip=$ip");
$json = json_decode($getJ);

############################################################################################ [BEGIN] AUTH_LOGIN
if (!empty($_POST['login']) and isset($_POST['login']) and !empty($_POST['password']) and isset($_POST['password']) and isset($_POST['form_enter']) and isset($_POST['token_user_recaptacha'])) {

    if ($json->success === $enableRecaptcha) {

        $login = inputProtec($_POST['login']);
        $password = encryptJ($_POST['password']);

        $data = array(
            'login' => $login
        );

        if (!getPassword($dbSrv, $data) == 0) {

            if (getPassword($dbSrv, $data) == $password) {

                $response['login']['success'] = true;
                setcookie("w-login", $login, time() + 3600);
                setcookie("w-password", $password, time() + 3600);

                unset($_POST);
                header("Refresh: 1; ?pag=admin-home");
            } else {
                $response['login']['error'] = true;
            }
        } else {

            $response['login']['error'] = true;
            error_log(" Error login < 1 " . date("Y-m-d H:i:s") . "\n", 3, WEB_NAME . ".log");
        }
    }
}
//END
############################################################################################ [BEGIN] REGISTER
if (
    !empty($_POST['login']) and isset($_POST['login']) and !empty($_POST['password']) and isset($_POST['password'])
    and !empty($_POST['rules']) and isset($_POST['rules']) and isset($_POST['form_register']) and
    isset($_POST['token_user_recaptacha'])
) {

    if ($json->success === $enableRecaptcha) {

        $login = inputProtec($_POST['login']);

        $password = encryptJ(inputProtec($_POST['password'])); //Crypted password

        if (strlen($_POST['password']) <= 16  and strlen($_POST['password']) >= 4) {

            if (verifyInDb($dbSrv, "accounts", "login", $login) === false) {

                $data = array(
                    'login' => $login,
                    'password' =>  $password,
                    'time' =>  strtotime(date('Y-m-d')),
                    'access_level' =>  $myData['access_level_players']
                );

                if (createAcc($dbSrv, $data) === true) {

                    $response['register']['success'] = true;
                    $response['register']['msg'] = "Registred";
                } else {

                    $response['register']['error'] = true;
                    $response['register']['msg'] = "strong error";
                }
            } else {

                $response['register']['error'] = true;
                $response['register']['msg'] = "Already Exists";
            }
        } else {

            $response['register']['error'] = true;
            $response['register']['msg'] = "Error";
        }
    }else {
		echo "recaptcha";
	}
}
//END
############################################################################################ [BEGIN] CHANGE_PASSWORD
if (isset($_POST['login']) and !empty($_POST['login']) and isset($_POST['old_password']) and !empty($_POST['old_password']) and isset($_POST['new_password']) and !empty($_POST['new_password']) and isset($_POST['form_change_password']) and isset($_POST['token_user_recaptacha'])) {

    if ($json->success === $enableRecaptcha) {

        $login = inputProtec($_POST['login']);
        $old_pass = encryptJ(inputProtec($_POST['old_password']));
        $new_password = encryptJ(inputProtec($_POST['new_password']));

        $result = getEmail($dbSrv, "accounts", "password", "login", $old_pass, $login);

        if (strlen($result) > 0) {

            if (updatePass($dbSrv, "accounts", "login", $result, $new_password) === true) {

                $response['change_password']['msg'] = "Success";
                $response['change_password']['success'] = true;

                if ($_COOKIE['w-password'] == $old_pass) {

                    $response['change_password']['msg'] = "Protection throw to main";
                    $response['change_password']['success'] = true;
                }
            } else {

                $response['change_password']['error'] = true;
            }
        } else {

            $response['change_password']['error'] = true;
        }
    }
}
//END
############################################################################################ [BEGIN] UNLOCK_CHAR
if (isset($_POST['char_n']) and !empty($_POST['char_n']) and isset($_POST['loc_x']) and !empty($_POST['loc_x']) and isset($_POST['loc_y']) and !empty($_POST['loc_y']) and isset($_POST['loc_z']) and !empty($_POST['loc_z']) and isset($_POST['form_unlock']) and isset($_POST['token_user_recaptacha'])) {

    if ($json->success === $enableRecaptcha) {

        $char_name = inputProtec($_POST['char_n']);
        $acc_name = inputProtec($_COOKIE['w-login']);

        $x = inputProtec($_POST['loc_x']);
        $y = inputProtec($_POST['loc_y']);
        $z = inputProtec($_POST['loc_z']);

        if (updateUnlock($dbSrv, $acc_name, $char_name, $x, $y, $z) === true) {

            $response['unlock']['success'] = true;
            $response['unlock']['msg'] = "Unlocked with success";
        } else {

            $response['unlock']['error'] = true;
        }
    }
}
//END
############################################################################################ [BEGIN] SEND_EMAIL_RECOVER_&OTHERS
if (isset($_POST['nick']) and !empty($_POST['nick']) and isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['subject']) and !empty($_POST['subject']) and isset($_POST['message']) and !empty($_POST['message']) and isset($_POST['form_recover'])) {

    $headers = $_POST['email'];
    $message = $_POST['nick'];
    $message = $_POST['subject'];
    $message = $_POST['message'];

    if (mail($myData['email'], $message, $headers) === true) {

        $response['recover']['success'] = true;
    } else {

        $response['recover']['error'] = true;
    }
}

//END
############################################################################################ [BEGIN] CONTACT
if (isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['message']) and !empty($_POST['message']) and isset($_POST['form_contact'])) {

    $headers = $_POST['email'];
    $message = $_POST['message'];

    if (mail($myData['email'], $message, $headers) === true) {

        $response['contact']['success'] = true;
    } else {

        $response['contact']['error'] = true;
    }
}
//END