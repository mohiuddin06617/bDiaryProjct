<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/23/2017
 * Time: 6:09 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/dbconfig.php";
if ($_SERVER['REQUEST_METHOD']=="POST") {
    $groupFinancialDataId=$_POST['groupFinancialDataId'];

    $sql = "UPDATE groupFinancialData SET isDeleted=0 WHERE groupFinancialDataId='$groupFinancialDataId'";

    if (mysqli_query($conn,$sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>