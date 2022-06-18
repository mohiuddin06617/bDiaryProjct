<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 1/21/2017
 * Time: 1:16 PM
 */
session_start();
include "DbFile/dbconfig.php";
$selectedPersonForCost=$_POST['selectedPersonForCost'];
$selectedMonth=$_POST['selectedMonth'];
$total=0;
if($selectedPersonForCost!=""){
    $selectCostByUserIdQ="SELECT user_id,entry_time_date,item_name,item_price,quantity from userdailycost WHERE manager_id='".$_SESSION['managerID']."'";
    $selectCostByUserId=mysqli_query($conn,$selectCostByUserIdQ);
    while ($row=mysqli_fetch_array($selectCostByUserId,MYSQLI_ASSOC)) {
        $monthSpliter = $row['entry_time_date'];
        $monthSpliter2 = explode("/", $monthSpliter);
        $month = $monthSpliter2[0];
        if ($month == $selectedMonth && $row['user_id']==$selectedPersonForCost) {
            echo "Entry Date:" . $row['entry_time_date'] ." Cost". $row['item_price']." Item Name:".$row['item_name']. "<br>";
            $total=$total+$row['item_price'];
        }
    }
    echo "Total Cost From getSelectedPersonMonthCost: ".$total;
}

?>