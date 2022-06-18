<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 12/31/2016
 * Time: 4:24 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class userFoodMenuFetch extends oodbconfig
{
    private $foodMenuDataInfo = array();
    private $oodbconfig;
    private $groupId;
    private $userId;
    /*$userGroupIdGetting = "SELECT group_id from userinfo WHERE email='".$_SESSION["email"]."'";
    $userGroupId = mysqli_fetch_array(mysqli_query($conn, $userGroupIdGetting), MYSQLI_ASSOC);
    $uGId = $userGroupId['group_id'];*/
    public function __construct()
    {
    $this->oodbconfig=new oodbconfig();
    $this->userId=isset($_SESSION['userID'])?$_SESSION['userID']:null;
    $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
    }

    public function getFoodMenuByTime($mealShowTime)
    {
        $slNo = 0;
        $conn=$this->oodbconfig->get_connection();
        $curr_date = date('Y-m-d');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $mealDataQuery = "SELECT inserted_time,item_name from foodmenu WHERE group_id='" .$this->groupId. "' AND inserted_date='" . $curr_date . "' AND inserted_time='" . $mealShowTime . "'";
        $mealDataResult = $conn->query($mealDataQuery);
        if ($mealDataResult->num_rows > 0) {
            echo "<table border='2' class='table table-striped table-bordered' cellpadding='1'><thead>
                          <tr class='text-center black-text-color info'><td colspan='2'>Todays <strong>".$mealShowTime."</strong> Meal List</td></tr>
                          <tr class='text-center warning'><th>SL No.</th><th>Item Name</th></tr></thead><tbody>";
            while ($row = $mealDataResult->fetch_assoc()) {
                //array_push($foodMenuDataInfo,$row['item_name'],$row['inserted_date']);
                $slNo++;

                echo "<tr><td>" . $slNo . "</td><td>" . $row["item_name"] . "</td></tr>";

            }
            echo "</tbody></table>";
        } else {
            echo "<div class='text-center'><h3>No Food Menu Entered</h3><button class='btn btn-warning'><i class='fa fa-info-circle'></i> Notify Manager</button></div>";
        }
    }

    public function getFoodMenuByDate($specificDate)
    {

        $slNo = 0;
        $conn=$this->oodbconfig->get_connection();

        $changed_date = DateTime::createFromFormat('d/m/Y', $specificDate);
        $headerDate=$changed_date->format("d/m/Y");
        $specificDate = $changed_date->format("Y-m-d");

        $specifiedDateMealQuery = "SELECT inserted_time,item_name from foodmenu WHERE group_id='$this->groupId' AND inserted_date='$specificDate' ORDER BY inserted_time";
        $specifiedDateMealData = $conn->query($specifiedDateMealQuery);
        if ($specifiedDateMealData->num_rows > 0) {
            echo "<br><table border='2' class='table table-bordered' cellpadding='10'><thead>
                          <tr><th  colspan='4' class='text-center black-text-color' style='font-size: 19px;background-color: #00e5ff;'>" . $headerDate . "</th></tr>
                          <tr class='text-center warning'><th>SL No.</th><th>Inserted Time</th><th>Item Name</th></tr></thead><tbody>";
            while ($row = $specifiedDateMealData->fetch_assoc()) {
                $slNo++;
                echo "<tr><td>" . $slNo . "</td><td>" . $row['inserted_time'] . "</td><td>" . $row["item_name"] . "</td></tr>";
            }
        } else {
            echo "<div class='text-center'><h3>No Food Menu Entered</h3><button class='btn btn-brown'><i class='fa fa-info-circle'></i> Let Manager Know</button></div>";
        }


    }


}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userFoodMenuFetch = new userFoodMenuFetch();
    if (!empty($_POST['specifiedDate'])) {
        $specifiedDate = $_POST['specifiedDate'];

        $userFoodMenuFetch->getFoodMenuByDate($specifiedDate);
    } elseif (!empty($_POST['mealShowTime'])) {
        $userFoodMenuFetch->getFoodMenuByTime($_POST['mealShowTime']);
    }

} else {
    echo "Not properly requested!";
}

?>