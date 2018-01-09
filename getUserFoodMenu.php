<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 12/31/2016
 * Time: 4:24 PM
 */
require "DbFile/dbconfig.php";
session_start();
$userGroupIdGetting="SELECT group_id from userinfo WHERE email='".$_SESSION["email"]."'";
$userGroupId=mysqli_fetch_array(mysqli_query($conn,$userGroupIdGetting),MYSQLI_ASSOC);
$uGId=$userGroupId['group_id'];
//echo $uGId.'<br>';

$userGroupManagerIdGetting="SELECT manager_id from groupdetails WHERE group_id='$uGId'";
$userGroupManagerId=mysqli_fetch_array(mysqli_query($conn,$userGroupManagerIdGetting),MYSQLI_ASSOC);
$managerId=$userGroupManagerId['manager_id'];

//echo "Managre Id: ".$managerId.'<br>';

if(!empty($_POST['mealtime']) && !empty($uGId)){

    $mealData="SELECT *from foodmenu WHERE group_id='$uGId'";
    $result=mysqli_query($conn,$mealData);
   // $foodMenuData=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if (!$result) {
        echo "Could not successfully run query ($mealData) from DB: " . mysqli_error();
        exit;
    }

    //echo json_encode(array('data'=>$foodMenuData));

    echo "<center>".date("m/d/Y")."</center>";
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['inserted_date'] == date("m/d/Y")) {
                if ($row['inserted_time'] == $_POST['mealtime']) {
                    echo "<table border='1' cellpadding='10'><tr><td>" . $row["item_name"] . "</td><td>";
                    echo $row['inserted_time'] . "</td></tr></table><br>";
                    //echo "Not Working   ";

                }
            }
        }

    /*if (mysql_num_rows($result) == 0) {
        echo "No rows found, nothing to print so am exiting";
        exit;
    }*/
    mysqli_free_result($result);
}
?>