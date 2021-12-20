<?php


/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param idTemplate
 * @param return fechAll
 */
function getAllDataTemplateById($idTemplate): array
{
    $dbc = new DbConnect();

    $proIdTemplate = inputProtec($idTemplate);

    $run = $dbc->conn->prepare("SELECT * FROM template WHERE id = '$proIdTemplate' ");
    $run->execute();

    return $run->fetchAll();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return all 
 */
function getAllWebName(): array
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT * FROM web_name");
    $run->execute();

    return $run->fetchAll();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return true or false if exist webname by id 
 */
function getCountWebName($id): int
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT count(*) FROM web_name WHERE account_id = " . $id);

    return $run->rowCount();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return the prece of template
 */
function getPriceTemplate($id_template): string
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT price FROM template WHERE id = " . $id_template);

    $run->execute();
    return $run->fetchColumn();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return the dyas of template
 */
function getDyasTemplate($id_template): string
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT dyas FROM template WHERE id = " . $id_template);

    $run->execute();
    return $run->fetchColumn();
}


/**
 * verify if account already have one order
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return status or zero if no have
 */

function verifyOrder($id)
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT status FROM orders WHERE id_user = '$id' and status != 'received' ");
    $run->execute();
    if ($run->rowCount() > 0)
        return $run->fetchColumn();
    else
        return 0;
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return All When by id 
 */
function orderAllById($id)
{

    try {
        $dbc = new DbConnect();
        $run = $dbc->conn->prepare("SELECT * FROM orders WHERE id_user = '$id' and status != 'received' ");
        $run->execute();

        if ($run->rowCount() > 0) {

            return $run->fetchAll();
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        return 0;
    }
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return All When by order 
 */
function getAllOrder($order)
{

    try {
        $dbc = new DbConnect();
        $run = $dbc->conn->prepare("SELECT * FROM orders WHERE num_order = '$order' ");
        $run->execute();

        if ($run->rowCount() > 0) {

            return $run->fetchAll();
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        return 0;
    }
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return All When by id 
 */
function getAllWebNameById($id) : array
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT * FROM web_name WHERE account_id = '$id' ");
    $run->execute();
    return $run->fetchAll();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return column with total visits
 */
function getTotalVisits($wbn): int
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT total_visit FROM web_name WHERE name = '$wbn' ");
    $run->execute();

    return $run->fetchColumn();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return all
 */
function getAllTempWebFreeOne(): array
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT * FROM web_temp WHERE free = 1 ");
    $run->execute();

    return $run->fetchAll();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return all
 */
function getAllTempWebFreeZero(): array
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT * FROM web_temp WHERE free = 0 ");
    $run->execute();

    return $run->fetchAll();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return END_DATA
 */
function getDataTemp($webNameId): string
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT end_data FROM web_temp WHERE web_name_id = '$webNameId' ");
    $run->execute();

    return $run->fetchColumn();
}

/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return all expired free
 */
function get_id_name_all_expired_free($current_data): array
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT web_name_id FROM web_temp WHERE end_data <= '$current_data' AND free = 0 ");
    $run->execute();
    return $run->fetchAll();
}


/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return all expired paid out
 */
function get_id_name_all_expired_paid($current_data): array
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT web_name_id FROM web_temp WHERE end_data <= '$current_data' AND free = 1 ");
    $run->execute();

    return $run->fetchAll();
}


/**
 * Development Naelson.g.saraiva@gmail.com
 * @since 0.0.0
 *
 * @param return name by id column
 */
function get_web_name_by_id($id): string
{

    $dbc = new DbConnect();
    $run = $dbc->conn->prepare("SELECT name FROM web_name WHERE id = '$id' ");

    $run->execute();
    return $run->fetchColumn();
}
