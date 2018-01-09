<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/23/2017
 * Time: 5:12 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/dbconfig.php";
if ($_SERVER['REQUEST_METHOD']=="POST") {
    $date=$_POST['id'];

    $sql = "UPDATE userDailyCost SET isDeleted=0 WHERE entry_time_date='$date'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>