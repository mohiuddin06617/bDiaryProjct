<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 01-Jul-17
 * Time: 2:54 AM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class userShoppingCostFetch extends oodbconfig
{

    private $month_name;
    private $selectedMonthName;
    private $oodbconfig;
    private $userId;
    private $groupId;
    private $specificDateBazarDataList=array();

    public function __construct()
    {
        $this->month_name = date('F');
        $this->oodbconfig = new oodbconfig();
        $this->userId = $_SESSION['userID'];
        $this->groupId = $_SESSION['groupID'];
    }

    function set_current_month_name($month_name)
    {
        $this->selectedMonthName = $month_name;
    }

    function userBazarDateCostList()
    {
        $total_amount = array();

        $conn = $this->oodbconfig->get_connection();
        $bazarDateCostListQuery = "SELECT group_id,manager_id,entry_time_date,item_name,SUM(item_price) AS item_p,quantity,manager_response
                                  from userdailycost WHERE user_id='$this->userId' AND group_id='$this->groupId' AND MONTH(entry_time_date)=MONTH(CURDATE()) GROUP BY entry_time_date";
        $bazarDateCostListResult = $conn->query($bazarDateCostListQuery);

        if ($bazarDateCostListResult->num_rows > 0) {
            // output data of each row
            echo "<div id=\"demo\"><table class=\"table table-bordered table-fixed-header m-n\" style=\"border: 2px;\" id=\"example\">
                                    <thead>
                                        <tr class='info' style='font-weight: bold !important;'>
                                              <th>Bazar Dates</th>
                                              <th>Manager Response</th>
                                              <th>Cost (BDT)</th>
                                              <th>Action</th>
                                        </tr>
                                    </thead>
                  <tbody style=\"background-color:#8ee0e8;text-align: center; color: black; \">";
            while ($row = $bazarDateCostListResult->fetch_assoc()) {
                $phpdate = strtotime($row['entry_time_date']);
                $mysqldate = date('d/m/Y', $phpdate);
                echo "<tr class='gradeX' id='".$row['entry_time_date']."'>
                         <td>" . $mysqldate. "</td>";
                if ($row['manager_response'] == 0) {
                    echo "<td><i class='fa fa-close'></i> Not Ok</td>";
                } elseif ($row['manager_response'] == 1) {
                    echo "<td><i class='fa fa-check-square'></i> Done</td>";
                }
                array_push($total_amount, $row['item_p']);
                echo "<td>" . $row['item_p'] . "</td>";
                echo "<td>
                        <button class='btn btn-info btn-getting showSpecificBazarDetails' id='".$row['entry_time_date']."'>
                            <i class='fa fa-info-circle'></i> Details</button>
                        <button class='btn btn-danger btn-getting deleteSpecificBazarDetails' id='".$row['entry_time_date']."'>
                            <i class='fa fa-trash-o'></i> Delete</button>
                      </td>
                      </tr>";
            }
            echo "</tbody>
                    <tfoot>";
            echo "<tr><td style='background-color: #00e5ff;font-weight: bolder;'>TOTAL AMOUNT</td><td colspan='3' style='background-color: powderblue;font-size: 19px;font-weight: bolder;'>" . array_sum($total_amount) . " TK</td></tr>";
            echo "</tfoot>
                   </table>";
        } else {
            echo "<h3 class='text-center text-danger'> No Shopping Data Available</h3>";
        }
        $conn->close();
    }

    function userTotalNoOfBazarDate()
    {
        $conn = $this->oodbconfig->get_connection();
        $totalNumberBazarDateQuery = "SELECT count(*) AS count_num_date,entry_time_date
                                  from userdailycost WHERE user_id='$this->userId' AND group_id='$this->groupId' AND MONTH(entry_time_date)=MONTH(CURDATE()) GROUP BY entry_time_date";
        $totalNumberBazarDateResult = $conn->query($totalNumberBazarDateQuery);
        $total_num = 0;
        if ($totalNumberBazarDateResult->num_rows > 0) {
            while ($row = $totalNumberBazarDateResult->fetch_assoc()) {
                $total_num = $total_num + count($row['entry_time_date']);

            }
            echo $total_num;
        }
        else{
            echo $total_num;
        }
    }

    function latestBazarDateManagerResponse()
    {
        $conn = $this->oodbconfig->get_connection();
        $latestBazarDateManagerResponseQuery = "SELECT entry_time_date,manager_response
                                  from userdailycost WHERE user_id='$this->userId' AND group_id='$this->groupId' AND MONTH(entry_time_date)=MONTH(CURDATE()) AND auto_entry_time IN(SELECT MAX(auto_entry_time) from userdailycost GROUP BY entry_time_date) GROUP BY entry_time_date DESC LIMIT 1";
        $latestBazarDateManagerResponseResult = $conn->query($latestBazarDateManagerResponseQuery);
        if ($latestBazarDateManagerResponseResult->num_rows > 0) {
            while ($row = $latestBazarDateManagerResponseResult->fetch_assoc()) {
                if ($row['manager_response'] == 0) {
                    echo "<div class='tile-icon'><i class='ti ti-close'></i></div>";
                    echo "<div class='tile-heading'><span>Status From Manager About Todays Bazar</span></div>";
                    echo "<div class='tile-body' style='font-size: 24px;color: black;'><span>Not Answered Yet</span></div>";
                } elseif ($row['manager_response'] == 1) {
                    echo "<div class='tile-icon'><i class='ti ti-face-smile'></i></div>";
                    echo "<div class='tile-heading'><span>Status From Manager About Todays Bazar</span></div>";
                    echo "<div class='tile-body' style='font-size: 24px;color: black;'><span>Approved</span></div>";
                } elseif ($row['manager_response'] == 2) {
                    echo "<div class='tile-icon'><i class='ti ti-alert'></i></div>";
                    echo "<div class='tile-heading'><span>Status From Manager About Todays Bazar</span></div>";
                    echo "<div class='tile-body' style='font-size: 24px;color: black;'><span>Modification Requested</span></div>";
                }
            }

        }
        else{
            echo "<div class='tile-icon'><i class='ti ti-close'></i></div>";
            echo "<div class='tile-heading'><span>Status From Manager About Todays Bazar</span></div>";
            echo "<div class='tile-body' style='font-size: 24px;color: black;'><span>No Data Available</span></div>";
        }
    }


    function userCurrentMonthTotalBazarCost()
    {
        $total_amount = array();
        $conn = $this->oodbconfig->get_connection();
        $totalBazarCostQuery = "SELECT SUM(item_price) AS item_p
                                  from userdailycost WHERE user_id='$this->userId' AND group_id='$this->groupId' AND MONTH(entry_time_date)=MONTH(CURDATE()) GROUP BY entry_time_date";
        $totalBazarCostResult = $conn->query($totalBazarCostQuery);

        if ($totalBazarCostResult->num_rows > 0) {
            while ($row = $totalBazarCostResult->fetch_assoc()) {
                array_push($total_amount, $row['item_p']);
            }
        }
        echo array_sum($total_amount);
    }
    public function setSpecificBazarDateData($specifiedDate)
    {
        $conn = $this->oodbconfig->get_connection();
        $specifiedDateFoodMenuQuery = "SELECT dailyCostTableId,item_name,item_price,quantity,manager_response from userdailycost WHERE 
                                      user_id='$this->userId' AND group_id='$this->groupId' and entry_time_date='$specifiedDate' ORDER BY entry_time_date DESC";
        $specifiedDateFoodMenuResult = $conn->query($specifiedDateFoodMenuQuery);
        if ($specifiedDateFoodMenuResult->num_rows > 0) {
            $row_array = array();
            while ($row = $specifiedDateFoodMenuResult->fetch_assoc()) {
                array_push($this->specificDateBazarDataList,$row);
                array_push($row_array,$row);

            }
            echo json_encode($row_array);

        } else {

            echo json_encode(0);
        }
    }


}

if ($_SERVER['REQUEST_METHOD']=="POST") {
    $userShoppingCostFetch = new userShoppingCostFetch();
    if (isset($_POST['showSpecificDateBazarDetails'])){
        /*$changed_date = DateTime::createFromFormat('Y-m-d', $_POST['showSpecificDateBazarDetails']);
        $specifiedDate = $changed_date->format("d/m/Y");*/
        $specifiedDate=$_POST['showSpecificDateBazarDetails'];
        $userShoppingCostFetch->setSpecificBazarDateData($specifiedDate);
    }
}
?>