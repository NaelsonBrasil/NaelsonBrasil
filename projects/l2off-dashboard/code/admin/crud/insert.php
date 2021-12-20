<?php

function setTemplate($plan, $price, $chronic, $project, $plataform, $category, $image)
{

    $dbc = new DbConnect();

    $arrayData = array(
        'free' => $plan,
        'price' => $price,
        'chronic' => $chronic,
        'project' => $project,
        'plataform' => $plataform,
        'category' => $category,
        'image' => $image
    );

    try {

        $sql = "INSERT INTO template (free,chronic,project,plataform,category,image) Value (:free,:chronic,:project,:plataform,:category,:image)";
        $run = $dbc->conn->prepare($sql);
        $run->execute($arrayData);
        return true;
    } catch (PDOException $e) {

        return false;
    }
}

function createWebName($accountId, $templateId, $webName, $projectName, $data,$id, $token)
{

    $dbc = new DbConnect();

    $arrayData = array(
        'account_id' => inputProtec($accountId),
        'template_id' => inputProtec($templateId),
        'name' => inputProtec($webName),
        'project_name' => inputProtec($projectName),
        'data' => $data,
        'ip_address' => $data,
        'token' => $token
    );

    if (
        verifyData('web_name', 'name', inputProtec($webName)) === 0
        and !empty($accountId) and !empty($templateId) and !empty($webName) and !empty($projectName) and !empty($data) and !empty($token)
    ) {

        try {

            $run = $dbc->conn->prepare("INSERT INTO web_name (account_id,template_id,name,project_name,data,ip_address,token) Value (:account_id,:template_id,:name,:project_name,:data,:ip_address,:token)");
            $run->execute($arrayData);

            return true;
        } catch (PDOException $e) {

            return false;
        }
    } else {

        return false;
    }
}

function tempDuraction($webNameId, $numberDays, $beginData, $endData, $plan, $status)
{

    $web_name_id = inputProtec($webNameId);
    $number_days = inputProtec($numberDays);
    $begin_data = inputProtec($beginData);
    $end_data = inputProtec($endData);
    $free = inputProtec($plan);
    $status = inputProtec($status);

    try {

        $dbc = new DbConnect();
        $dbc->conn->query("INSERT INTO web_temp (web_name_id,number_days,begin_data,end_data,free,status) Value ('$web_name_id','$number_days','$begin_data','$end_data','$free','$status') ");

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// Insert Orders
/**
 *  id
 * 	id_user
 * 	site_id
 * 	site_name
 * 	num_order
 * 	price
 * 	quantity
 * 	discount
 * 	status
 * 	data_order
 * 	data_aproved
 * 	token
 * @since 0.0.0
 *
 * @param return true or false
 */
function order($id_user, $site_id, $site_name, $num_order, $price, $qty_dyas, $discount, $status, $order_data, $token)
{

    $dbc = new DbConnect();

    $data = array(
        'id_user' => $id_user,
        'site_id' => $site_id,
        'site_name' => $site_name,
        'num_order' => $num_order,
        'price' => $price,
        'dyas' => $qty_dyas,
        'discount' => $discount,
        'status' => $status,
        'data_order' => $order_data,
        'token' => $token
    );

    try {

        $sql = "INSERT INTO orders (id_user,site_id,site_name,num_order,price,dyas,discount,status,data_order,token) Value 
        (:id_user,:site_id,:site_name,:num_order,:price,:dyas,:discount,:status,:data_order,:token)";
        $run = $dbc->conn->prepare($sql);
        $run->execute($data);

        return true;
    } catch (PDOException $e) {

        return false;
    }
}


// Insert Orders
/**
 *  id
 * 	ip
 *  token
 * 	data
 * @since 0.0.0
 *
 * @param return true or false
 */
function whoCanceled($db,$id_user, $ip_address, $token, $data)
{

    $data = array(
        'id_user' => $id_user,
        'ip' => $ip_address,
        'token' => $token,
        'data_time' => $data
    );

    try {

        $sql = "INSERT INTO who_canceled (id_user,ip,token,data_time) Value 
        (:id_user,:ip,:token,:data_time)";
        $run = $db->conn->prepare($sql);
        $run->execute($data);

        return true;

    } catch (PDOException $e) {

        return false;
    }
}
