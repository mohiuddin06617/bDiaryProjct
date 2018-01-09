<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/23/2017
 * Time: 3:52 PM
 */
include_once "DbFile/dbconfig.php";
include_once "sessionStartCheck.php";

    if (isset($_POST['groupShowId'])){

        $userId=$_SESSION['userID'];
        $groupShowId=$_POST['groupShowId'];
        $groupId=$groupShowId;
        $requestStatus=2;
        $sql = "INSERT INTO groupjoindetails (user_id, group_id, request_status)
            VALUES ('$userId', '$groupId', '$requestStatus')";
        if (mysqli_query($conn,$sql) === TRUE) {
            echo "Join Request Sent";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

?>