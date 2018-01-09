<?php

include_once "sessionStartCheck.php";
include_once "DbFile/dbconfig.php";

$array = array();
$array_id = array();
$all = array();

if (!empty($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    $query = "select * from userinfo where email LIKE '%" . $searchTerm . "%'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($all,$row);
        /*$all = array('id' => $array_id, 'group_name' => $array);*/
    }
    /*$all = array_combine($array_id, $array);*/
    echo json_encode($all);
}
?>