<?php
require_once "db.php";

function get_course_by_id($id)
{
    global $connection;

    $query = "SELECT * FROM tovar WHERE id=" . $id;
    $req = mysqli_query($connection, $query);
    $resp = mysqli_fetch_assoc($req);

    return $resp;
}

function get_course_count_id($id)
{
    global $connection;

    $query = "SELECT id FROM tovar WHERE id=" . $id;
    $req = mysqli_query($connection, $query);
    $resp = mysqli_fetch_assoc($req);

    return $resp;
}


function viewNewsTovar()
{
    global $connection;
    $query = "SELECT * FROM `tovar` ORDER BY id DESC LIMIT 3;";
    $req = mysqli_query($connection, $query);
    $data_from_db = [];
    while ($result = mysqli_fetch_assoc($req)) {
        $data_from_db[] = $result;
    }
    return $data_from_db;
}

function viewDiscountTovar()
{
    global $connection;
    $query = "SELECT * FROM `tovar` WHERE price_prev > 0 ORDER BY id DESC LIMIT 3;";
    $req = mysqli_query($connection, $query);
    $data_from_db = [];
    while ($result = mysqli_fetch_assoc($req)) {
        $data_from_db[] = $result;
    }
    return $data_from_db;
}
function ViewAllTovar()
{
    global $connection;
    $query = "SELECT * FROM `tovar`";
    $req = mysqli_query($connection, $query);
    $data_from_db = [];
    while ($result = mysqli_fetch_assoc($req)) {
        $data_from_db[] = $result;
    }
    return $data_from_db;
}

function countTovarOrder($itemId, $countOrder)
{
    global $connection;
    $query = "SELECT counts FROM `tovar` WHERE id = $itemId;";
    $req = mysqli_query($connection, $query);
    $countOrder = [];
    while ($result = mysqli_fetch_assoc($req)) {
        $countOrder[] = $result;
    }
    return $countOrder;
}
