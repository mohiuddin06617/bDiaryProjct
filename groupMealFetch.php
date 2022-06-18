<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 11/27/2017
 * Time: 12:20 PM
 */
include_once "sessionStartCheck.php";
require_once "DbFile/oodbconfig.php";

class groupMealFetch extends oodbconfig
{

    private $breakfastCheck;
    private $lunchCheck;
    private $dinnerCheck;
    private $oodbconfig;
    private $today;
    private $managerID;
    private $email;
    private $groupID;
    private $breakfastTotalMeal;
    private $lunchTotalMeal;
    private $dinnerTotalMeal;
    private $todayTotalNoOfMeal;
    private $monthTotalNoOfMeal;
    private $breakFastNoOfMeal;
    private $lunchNoOfMeal;
    private $dinnerNoOfMeal;
    private $userTotalNoOfMeal;
    private $perMealCost;
    private $totalBazarCost;
    private $totalGroupMember;

    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->today = date('Y-m-d 00:00:00'); //Mysql Database Table DateTime format
        $this->managerID = isset($_SESSION['managerID'])?$_SESSION['managerID']:null;
        $this->groupID = isset($_SESSION['groupID']) ? $_SESSION['groupID'] : null;
        $this->email = $_SESSION['email'];
        $this->setBreakfastCheck();
        $this->setLunchCheck();
        $this->setLunchCheck();
        $this->setDinnerCheck();
        $this->setBreakfastTotalMeal();
        $this->setLunchTotalMeal();
        $this->setDinnerTotalMeal();
        $this->setTodayTotalNoOfMeal();
        $this->setMonthTotalNoOfMeal();
        $this->setTotalBazarCost();
        $this->setTotalGroupMember();
        $this->setPerMealCost();
    }

    /**
     * @return mixed
     */
    public function getBreakfastCheck()
    {
        return $this->breakfastCheck;
    }

    /**
     * @param mixed $breakfastCheck
     */
    private function setBreakfastCheck()
    {
        $conn = $this->oodbconfig->get_connection();
        $breakfastStatusCheckQuery = "select answer,sum(noOfMeal) as 'totalBreakfast' from mealstatus where mealtime='Breakfast' and 
        mealentrytime='$this->today' and user_id='$this->managerID' and userGroupId='$this->groupID' GROUP BY mealentrytime";
        $breakfastStatusCheckResult = $conn->query($breakfastStatusCheckQuery);

        if ($breakfastStatusCheckResult->num_rows > 0) {
            $this->breakfastCheck = false;
            while ($row = $breakfastStatusCheckResult->fetch_assoc()) {
                $this->breakFastNoOfMeal = $row['totalBreakfast'];
            }
        } else {
            $this->breakfastCheck = true;
        }


    }


    /**
     * @param mixed $lunchCheck
     */
    private function setLunchCheck()
    {
        $conn = $this->oodbconfig->get_connection();
        $lunchStatusCheckQuery = "select answer,sum(noOfMeal) as 'totalLunch' from mealstatus where mealtime='Lunch' and 
        mealentrytime='$this->today' and user_id='$this->managerID' and userGroupId='$this->groupID' GROUP BY mealentrytime";
        $lunchStatusCheckResult = $conn->query($lunchStatusCheckQuery);
        if ($lunchStatusCheckResult->num_rows > 0) {
            $this->lunchCheck = false;
            while ($row = $lunchStatusCheckResult->fetch_assoc()) {
                $this->lunchNoOfMeal = $row['totalLunch'];
            }
        } else {
            $this->lunchCheck = true;
        }
    }

    /**
     * @param mixed $dinnerCheck
     */
    private function setDinnerCheck()
    {
        $conn = $this->oodbconfig->get_connection();
        $dinnerStatusCheckQuery = "select answer,sum(noOfMeal) as 'totalDinner' from mealstatus where mealtime='Dinner' and 
            mealentrytime=CURRENT_DATE and user_id='$this->managerID' and userGroupId='$this->groupID' GROUP BY mealentrytime";
        $dinnerStatusCheckResult = $conn->query($dinnerStatusCheckQuery);
        if ($dinnerStatusCheckResult->num_rows > 0) {
            $this->dinnerCheck = false;
            while ($row = $dinnerStatusCheckResult->fetch_assoc()) {
                $this->dinnerNoOfMeal = $row['totalDinner'];
            }
        } else {
            $this->dinnerCheck = true;
        }
    }


    /**
     * @param mixed $breakfastTotalMeal
     * @return userMealFetch
     */
    private function setBreakfastTotalMeal()
    {
        $conn = $this->oodbconfig->get_connection();
        $totalNoOfBreakfastMealQuery = "select sum(noOfMeal) AS total_breakfast_meal from mealstatus where mealstatus.mealtime='Breakfast' 
            and mealstatus.mealentrytime='$this->today' and mealstatus.userGroupId='$this->groupID' GROUP BY mealentrytime";
        $totalNoOfBreakfastMealResult = $conn->query($totalNoOfBreakfastMealQuery);
        $row = $totalNoOfBreakfastMealResult->fetch_assoc();

        $this->breakfastTotalMeal = $row['total_breakfast_meal'];
    }

    /**
     * @return mixed
     */
    public function getLunchTotalMeal()
    {
        if($this->lunchTotalMeal){
            return $this->lunchTotalMeal;
        }
        else{
            return 0;
        }
    }

    /**
     * @param mixed $lunchTotalMeal
     * @return userMealFetch
     */
    private function setLunchTotalMeal()
    {
        $conn = $this->oodbconfig->get_connection();
        $totalNoOfLunchMealQuery = "select sum(noOfMeal) AS total_lunch_meal from mealstatus where mealstatus.mealtime='Lunch' and
        mealstatus.mealentrytime='$this->today' and mealstatus.userGroupId='$this->groupID' GROUP BY mealentrytime";
        $totalNoOfLunchMealResult = $conn->query($totalNoOfLunchMealQuery);
        $row = $totalNoOfLunchMealResult->fetch_assoc();
        $this->lunchTotalMeal = $row['total_lunch_meal'];
    }

    /**
     * @return mixed
     */
    public function getDinnerTotalMeal()
    {
        if($this->dinnerTotalMeal){
            return $this->dinnerTotalMeal;
        }
        else{
            return 0;
        }
    }

    /**
     * @param mixed $dinnerTotalMeal
     * @return userMealFetch
     */
    private function setDinnerTotalMeal()
    {
        $conn = $this->oodbconfig->get_connection();
        $totalNoOfDinnerMealQuery = "select sum(noOfMeal) AS total_dinner_meal from mealstatus where mealstatus.mealtime='Dinner' and 
        mealstatus.mealentrytime='$this->today' and mealstatus.userGroupId='$this->groupID'";
        $totalNoOfDinnerMealResult = $conn->query($totalNoOfDinnerMealQuery);
        $row = $totalNoOfDinnerMealResult->fetch_assoc();
        $this->dinnerTotalMeal = $row['total_dinner_meal'];
    }

    /**
     * @param mixed $todayTotalNoOfMeal
     */
    private function setTodayTotalNoOfMeal()
    {
        $this->todayTotalNoOfMeal = $this->getBreakfastTotalMeal() + $this->getLunchTotalMeal() + $this->getDinnerTotalMeal();
    }


    public function getTodayTotalNoOfMeal()
    {
        if ($this->todayTotalNoOfMeal){
            return $this->todayTotalNoOfMeal;
        }
        else{
            return 0;
        }

    }


    private function setMonthTotalNoOfMeal()
    {
        $conn = $this->oodbconfig->get_connection();
        $currentMonthTotalGroupMealQuery = "select sum(noOfMeal) as month_total_group_meal from mealstatus where MONTH(mealentrytime) = MONTH(CURRENT_DATE()) and userGroupId='$this->groupID' GROUP BY MONTH(mealentrytime)";
        $currentMonthTotalGroupMealResult = $conn->query($currentMonthTotalGroupMealQuery);
        $row = $currentMonthTotalGroupMealResult->fetch_assoc();
        $this->monthTotalNoOfMeal = $row['month_total_group_meal']!=0?$row['month_total_group_meal']:1;
    }


    public function currentMonthGroupMealList()
    {
        $conn = $this->oodbconfig->get_connection();
        $sevenDaysAgoDate = date('Y-m-d 00:00:00', strtotime('-7 days'));
        $query = "select mealStatusId,answer,mealentrytime,sum(noOfMeal) as 'total' from mealstatus WHERE userGroupId='$this->groupID' and 
        MONTH(mealstatus.mealentrytime)=MONTH(CURRENT_DATE) GROUP BY mealstatus.mealentrytime";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mysqldate = $this->formatDate($row['mealentrytime']);
                $mealStatusId=$row['mealStatusId'];
                echo "<tr id='" . $mealStatusId . "'>
                        <td width='35%'>
                            <span class='editSpan selected_date'>" . $mysqldate . "</span>
                            <input class='editInput selected_date form-control black-text-color' type='text' 
                            name='selected_date' value='" . $mysqldate . "' 
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td width='25%'>
                            <span class='editSpan total_meal'>" . $row['total'] . "</span>
                            <input class='editInput total_meal form-control black-text-color' type='number' min='0'
                            name='total_meal' value='" . $row['total'] . "' 
                            style='display: none;border: 1px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;' >
                        </td>
                        <td width='40%'>
                        <a type='button' class='btn btn-info btn-getting btn-lg showSpecificMealDetails' id='".$row['mealentrytime']."'>
                                    <i class='fa fa-info-circle' aria-hidden='true'></i> Deatils </a>
                        <!--<a type=\"button\" class=\"btn btn-link btn-danger btn-getting white-text-color deleteBtn\">
                                    <i class=\"fa fa-trash\"></i> Delete</a>
                        <a type=\"button\" class=\"btn btn-warning btn-getting updateBtn\" style='display: none;'>
                                    <i class=\"fa fa-refresh\"></i> Update</a>
                        <a type=\"button\" class=\"btn btn-danger white-text-color cancelBtn\" style='display: none;'>
                                    <i class=\"fa fa-times\"></i> Cancel</a>-->
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'><h3 class='text-center'>No Meal Selected</h3></td></tr>";
        }
    }

    private function getNameById($userId){
        $fullName="";
        $conn = $this->oodbconfig->get_connection();
        $sql="select firstname,lastname from userinfo where id='".$userId."'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        if ($conn->affected_rows>0){
            $fullName= ucwords($row['firstname']." ".$row['lastname']);
        }
        return $fullName;
    }
    public function nextSevenDaysDinnerFetch()
    {
        $conn = $this->oodbconfig->get_connection();
        $nextSevenDaysDate = date('Y-m-d 00:00:00', strtotime('+7 days'));
        $query = "select mealStatusId,answer,mealentrytime,noOfMeal as 'total' from mealstatus WHERE userGroupId='$this->groupID' AND user_id='$this->managerID' and
        mealtime='Dinner' AND mealstatus.mealentrytime>CURRENT_DATE and mealstatus.mealentrytime<='$nextSevenDaysDate'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mysqldate = $this->formatDate($row['mealentrytime']);
                /*$phpdate = strtotime();
                $mysqldate = date( 'd-M-Y', $phpdate );
                $idDate=date( 'Y-m-d', $phpdate );*/
                $mealStatusId=$row['mealStatusId'];
                echo "<tr id='" . $mealStatusId . "'>
                        <td width='35%'>
                            <span class='editSpan selected_date'>" . $mysqldate . "</span>
                            <input class='editInput selected_date form-control black-text-color' type='text' 
                            name='selected_date' value='" . $mysqldate . "' 
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td width='25%'>
                            <span class='editSpan total_meal'>" . $row['total'] . "</span>
                            <input class='editInput total_meal form-control black-text-color' type='number' min='0' 
                            name='total_meal' value='" . $row['total'] . "' 
                            style='display: none;border: 1px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td width='40%'>
                            <a type='button' class='btn btn-primary btn-getting editBtn'>
                                        <i class='fa fa-edit' aria-hidden='true'></i> Change </a>
                            <a type=\"button\" class=\"btn btn-link btn-danger btn-getting white-text-color deleteBtn\">
                                        <i class=\"fa fa-trash\"></i> Delete</a>
                            <a type=\"button\" class=\"btn btn-warning btn-getting updateBtn\" style='display: none;'>
                                        <i class=\"fa fa-refresh\"></i> Update</a>
                            <a type=\"button\" class=\"btn btn-danger white-text-color cancelBtn\" style='display: none;'>
                                        <i class=\"fa fa-times\"></i> Cancel</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3' class='text-center'><h3>No data Available</h3></td></tr>";
        }
    }




    private function setTotalBazarCost()
    {
        $conn = $this->oodbconfig->get_connection();
        $query = "SELECT SUM(item_price) 
                            AS 'total_bazar_cost'
                            FROM `userdailycost`
                            WHERE group_id='$this->groupID' AND Month(entry_time_date)= Month(CURRENT_DATE) 
                            AND YEAR(entry_time_date)=YEAR(CURDATE()) GROUP BY Month(entry_time_date)";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->totalBazarCost = round($row['total_bazar_cost'], 2);
            }
        } else {
            $this->totalBazarCost = 1;
        }
    }


    private function setTotalGroupMember()
    {
        $conn = $this->oodbconfig->get_connection();
        $totalMemberQuery = "select total_member from groupDetails where group_id='" . $this->groupID . "'";
        $totalMember = $conn->query($totalMemberQuery);
        if ($totalMember->num_rows > 0) {
            $row = $totalMember->fetch_assoc();
            $this->totalGroupMember = $row['total_member'];

        } else {
            $this->totalGroupMember = 1;
        }
    }

    public function specificMealDateDetailsData($specifiedDate)
    {
        $conn = $this->oodbconfig->get_connection();

    /*    $changed_date = DateTime::createFromFormat('d/m/Y', $specifiedDate);
        $specifiedDate = $changed_date->format("Y-m-d");*/

        $specifiedDateFoodMenuQuery="SELECT mealtime,SUM(noOfMeal) as 'no_of_meal' from mealstatus WHERE userGroupId='$this->groupID' and
        mealstatus.mealentrytime='$specifiedDate' GROUP BY mealentrytime,mealtime";
        $specifiedDateFoodMenuResult = $conn->query($specifiedDateFoodMenuQuery);
        if ($specifiedDateFoodMenuResult->num_rows > 0) {
            $row_array = array();
            while ($row = $specifiedDateFoodMenuResult->fetch_assoc()) {
                array_push($row_array,$row);
            }
            echo json_encode($row_array);

        } else {

            echo json_encode(0);
        }
    }

    private function formatDate($date)
    {
        $changed_date = DateTime::createFromFormat('Y-m-d 00:00:00', $date);
        $newFormattedDate = $changed_date->format("d/m/Y");
        return $newFormattedDate;
    }

    public function setPerMealCost()
    {
        $this->perMealCost = round($this->totalBazarCost / $this->getMonthTotalNoOfMeal(), 2);
    }

    public function getPerMealCost()
    {
        return $this->perMealCost;
    }

    public function getTotalGroupMember()
    {
        return $this->totalGroupMember;
    }


    public function getMonthTotalNoOfMeal()
    {
        if($this->monthTotalNoOfMeal){
            return $this->monthTotalNoOfMeal;
        }
        else{
            return 0;
        }

    }


    public function getBreakFastNoOfMeal()
    {
        return $this->breakFastNoOfMeal;
    }


    public function getLunchNoOfMeal()
    {
        return $this->lunchNoOfMeal;
    }


    public function getDinnerNoOfMeal()
    {
        return $this->dinnerNoOfMeal;
    }


    public function getBreakfastTotalMeal()
    {
        if($this->breakfastTotalMeal){
            return $this->breakfastTotalMeal;
        }
        else{
            return 0;
        }
    }
}
$groupMealFetch=new groupMealFetch();
if ($_SERVER['REQUEST_METHOD']==="POST"){
    if (isset($_POST['action'])){
       if ( $_POST['action']==="specificDateMealDetails" && isset($_POST['showSpecificDateMealDetails'])){
           $showSpecificDateMealDetails=$_POST['showSpecificDateMealDetails'];
           echo $groupMealFetch->specificMealDateDetailsData($showSpecificDateMealDetails);
       }
       elseif ($_POST['action']=="specificDateFetch" && isset($_POST['specificDateMealDetails'])){
           $showSpecificDateMealDetails=$_POST['specificDateMealDetails'];
           $changed_date = DateTime::createFromFormat('d/m/Y', $showSpecificDateMealDetails);
           $showSpecificDateMealDetails = $changed_date->format("Y-m-d");
           //echo $showSpecificDateMealDetails;
           echo $groupMealFetch->specificMealDateDetailsData($showSpecificDateMealDetails);
       }
    }
}
?>