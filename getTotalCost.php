<!DOCTYPE html>
<html>
<head>
   <!-- <link href = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>

    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.1.1.min.js"></script>-->


</head>
<body>


<?php

include "DbFile/dbconfig.php";

session_start();

    class totalCost
    {

        function getUserTotalCost($userId)
        {
            $totalCost = 0;
            $groupCostQuery = "SELECT entry_time_date,item_price from userdailycost WHERE user_id=$userId";
            $groupCost = mysqli_query(mysqli_connect("localhost", "root", "", "bdiary"), $groupCostQuery);
            /*echo "<table class='table table-hover table-bordered' style='border: 1px;'>
                <th>Entry Date</th>
                <th>Cost</th>";*/

            ?>

    <?php
            while ($row = mysqli_fetch_array($groupCost, MYSQLI_ASSOC)) {
                $totalCost = $totalCost + $row['item_price'];
/*                echo "<tr class='alert-info'><td>". $row['entry_time_date'] . " </td><td>" . $row['item_price'] . "</td></tr>";*/
            }
/*            echo "<tr class='active'><td>Total Cost: </td><td>" . $totalCost."</td></tr>" ;*/
            echo "<div class='well well-sm text-center'><h3>Your Total Cost Of this month: </h3><h1>".$totalCost."</h1></div>";
/*            echo "</table>";*/

        }

        function getGroupTotalCost($managerId)
        {
            $totalCost = 0;
            $getGroupIdQ="SELECT group_id from groupDetails WHERE manager_id='$managerId'";
            $getGroupId=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost", "root", "", "bdiary"),$getGroupIdQ));
            $groupId=$getGroupId['group_id'];

            $groupCostQuery = "SELECT item_price from userdailycost WHERE group_id='$groupId' AND manager_id='$managerId'";
            $groupCost = mysqli_query(mysqli_connect("localhost", "root", "", "bdiary"), $groupCostQuery);
            while ($row = mysqli_fetch_array($groupCost, MYSQLI_ASSOC)) {
                $totalCost = $totalCost + $row['item_price'];

            }
           return "Total Group Cost:".$totalCost."<br>";
        }

    }
    class userBazarDetails{
            function getUserGroupId($userId){


            }
            function getUserBazarDateList(){
                $userId= $_SESSION['userID'];
                $getGroupIdQ="SELECT group_id from userinfo WHERE id='$userId'";
                $getGroupId=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost", "root", "", "bdiary"),$getGroupIdQ));
                $groupId=$getGroupId['group_id'];

                $managerIdQ="SELECT manager_id from groupDetails WHERE group_id='$groupId'";
                $getManagerId = mysqli_fetch_array(mysqli_query(mysqli_connect("localhost", "root", "", "bdiary"),$managerIdQ));
                $managerId = $getManagerId['manager_id'];

                $bazarDateQ = "SELECT selected_date from shoppingpersonselection 
                            WHERE manager_id='$managerId' AND selected_person_id='$userId'";
                $getBazarDate = mysqli_query(mysqli_connect("localhost", "root", "", "bdiary"),$bazarDateQ);
                $total=0;
                echo "<div class='well well-sm alert alert-info'><h2>Your Bazar Dates List</h2></div>";

                echo "<table class='table table-bordered table-hover' style='border: 1px;'>
                <th class='text-center'>Your Bazar Dates</th>
                <th class='text-center'>Status</th>";

                while ($row = mysqli_fetch_array($getBazarDate, MYSQLI_ASSOC)) {

                    $today = date("Y-m-d");
                    $today_time = strtotime($today);

                    $pastday=$row['selected_date'];
                    $selectedday_time=strtotime($pastday);

                    $today_dt=new DateTime($today);
                    $selected_dt=new DateTime($row['selected_date']);

                    $date=explode('-',$row['selected_date']);
                    echo "<tr class='active'><td>". $row['selected_date']  . " </td><td>";
                    if($today_dt > $selected_dt){
                    echo "<button type=\"button\" class=\"btn btn-default btn-sm btn-success\">
          <span class=\"glyphicon glyphicon-ok\"></span> Done </button></td></tr>";
                    }
                    if ($today_dt == $selected_dt){
                         echo "<button type=\"button\" class=\"btn btn-default btn-sm btn-group btn-group-lg btn-info\">
          <span class=\"glyphicon glyphicon-ok\"></span> Today </button></td></tr>";
                    }
                    if ($today_dt<$selected_dt){
                        echo "<button type=\"button\" class=\"btn btn-default btn-sm btn-warning\">
          <span class=\"glyphicon glyphicon-ok\"></span> Upcoming </button></td></tr>";
                    }



                }
            }
    }
/*if(isset($_SESSION['managerID'])) {*/
    $id = $_POST['id'];
    $t = new totalCost();
    $bazarDetails=new userBazarDetails();
    //echo $t->getGroupTotalCost($_SESSION['userID']);


//$t->getGroupTotalCost(6,1);
/*}
else if(!empty($_SESSION['userID'])){*/

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-9 col-md-10" style=" background-color: indianred">
        <?php
        echo $t->getUserTotalCost($id);
        ?>
        </div>
    </div>
</div>

    <div class="row">

        <div class="col-xs-5 col-md-5 text-center" style="background-color:lavender;">


            <?php
            if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
                echo $bazarDetails->etUserBazarDateList();
            }
            ?>
        </div>


    </div>



</body>
</html>
