<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 11/27/2017
 * Time: 4:36 PM
 */

include_once "sessionStartCheck.php";
require_once "DbFile/oodbconfig.php";
class userMealEntry extends oodbconfig{
    private $oodbconfig;
    private $today;
    private $userId;
    private $groupId;
    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->today=date('Y-m-d');
        $this->userId=isset($_SESSION['userID'])?$_SESSION['userID']:null;
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
    }
    private function convertToMysqlDate($stringDate){

        $seconds=strtotime($stringDate);
        if (!$seconds) return false;
        return date("Y-m-d 00:00:00",$seconds);
    }
    public function enterTodayFoodTime($selected_time,$noOfMeal){
        $conn=$this->oodbconfig->get_connection();
        $answer='yes';
        //$selected_time=mysqli_real_escape_string($conn,strtolower($selected_time));
        $this->today=$this->convertToMysqlDate($this->today);
        $insertSelectedTimeQuery = $conn->prepare(
            "INSERT into mealstatus(answer,mealtime,mealentrytime, noOfMeal,user_id,userGroupid) VALUES (?,?,?,?,?,?)");
        $insertSelectedTimeQuery->bind_param('sssiii',$answer,$selected_time,$this->today,$noOfMeal,$this->userId,$this->groupId);
        $result=$insertSelectedTimeQuery->execute();
        if ($result){
            return "Success!";

        }
        else{
            return "Error ".$conn->error;
        }

    }
    public function removeTodayFoodTime($selected_removal_time){
        $conn=$this->oodbconfig->get_connection();
        $this->today=$this->convertToMysqlDate($this->today);

        $deleteSelectedTimeQuery="DELETE FROM mealstatus WHERE mealtime='$selected_removal_time' and mealentrytime=CURRENT_DATE and userGroupId='$this->groupId' and user_id='$this->userId'";
        if ($conn->query($deleteSelectedTimeQuery)){
            return "Successfully Removed!";
        }
        else {
            return "Error Removing Mealtime record: " . $conn->error;
        }
    }

    public function checkMealTimeDate($date, $time, $noOfMeal)
    {
        $ultimateExst=false;
        $noOfMealChangeStat=false; //true means permission to go ahead
        $dateTimeExst=false;
        $conn = $this->oodbconfig->get_connection();
        $changed_date = DateTime::createFromFormat('d/m/Y', $date);
        $date = $changed_date->format("Y-m-d");
        $checkDateQuery = "select noOfMeal from mealstatus WHERE  mealentrytime='$date' and mealtime='$time' 
        AND userGroupId='$this->groupId' and user_id='$this->userId'";
        $dateCheckResult = $conn->query($checkDateQuery);
        if ($dateCheckResult->num_rows > 0) {
            while ($row = $dateCheckResult->fetch_assoc()) {
                if ($row['noOfMeal']!=$noOfMeal){
                    $noOfMealChangeStat=true; //true means user have changed the No Of Meal
                }
                elseif ($row['noOfMeal']==$noOfMeal){
                    $noOfMealChangeStat=false; //true means user did not change the No Of Meal
                }
            }
            $dateTimeExst=true;
        }
        if ($dateTimeExst) {
            if ($noOfMealChangeStat) {
                $ultimateExst = true;
            } elseif (!$noOfMealChangeStat) {
                $ultimateExst = false;
            }
        }
        return $ultimateExst;
    }

    public function checkTimeDataExistence($date,$time){
        $stat=false; // $stat true means data exist
        $conn=$this->oodbconfig->get_connection();
        $changed_date = DateTime::createFromFormat('d/m/Y', $date);
        $date = $changed_date->format("Y-m-d");
        $checkDateQuery="select * from mealstatus WHERE  mealentrytime='$date' and mealtime='$time' 
        AND userGroupId='$this->groupId' and user_id='$this->userId'";
        $dateCheckResult=$conn->query($checkDateQuery);
        if ($conn->affected_rows>0){
            $stat=true;
        }
        return $stat;
    }

    public function saveSpecificDateMealStatus($date, $selected_time, $noOfMeal,$answer)
    {
        $conn = $this->oodbconfig->get_connection();
        $changed_date = DateTime::createFromFormat('d/m/Y', $date);
        $date = $changed_date->format("Y-m-d");
        $sql = $conn->prepare(
            "insert into mealstatus(answer,mealtime,mealentrytime, noOfMeal,user_id,userGroupid) VALUES (?,?,?,?,?,?)");
        $sql->bind_param('sssiii', $answer, $selected_time, $date, $noOfMeal, $this->userId, $this->groupId);
        $result = $sql->execute();
        if ($result) {
            return "Successfully Inserted!";
        } else {
            return "Error " . $conn->error;
        }
    }
    public function deleteUserMealEntry($selected_id)
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $sql = "delete from mealStatus WHERE userGroupId='$this->groupId' AND mealStatusId='$selected_id'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $stat = true;
        }
        return $stat;
    }

    public function updateUserMealEntry($tableId,$selected_date,$noOfMeal){
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $changed_date = DateTime::createFromFormat('d/m/Y', $selected_date);
        $selected_date = $changed_date->format("Y-m-d");

        $updateQuery=$conn->prepare("Update mealStatus SET mealStatus.mealentrytime=?,
           mealStatus.noOfMeal=? WHERE mealStatus.user_id=? AND mealStatus.userGroupId=? AND mealStatus.mealStatusId=?");
        $updateQuery->bind_param('siiii',$selected_date,$noOfMeal,$this->userId,$this->groupId,$tableId);
        $result=$updateQuery->execute();
        if ($result){
            if ($updateQuery->affected_rows>0){
                $stat=true;
            }
        }
        return $stat;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userMealEntry=new userMealEntry();
    if (isset($_POST['selected_time'])) {
        if (isset($_POST['noOfMeal'])){
            $noOfMeal=$_POST['noOfMeal'];
        }
        else{
            $noOfMeal=1;
        }
        $today=date('d/m/Y');
        $selected_time=$_POST['selected_time'];
        //echo $selected_time."<br>";
        if (!$userMealEntry->checkTimeDataExistence($today,$selected_time)){
            echo $userMealEntry->enterTodayFoodTime($selected_time,$noOfMeal);
        }
        else{
            echo "<h3 class='text-center black-text-color'>Data Already Exists</h3>";
        }

    }
    if (isset($_POST['selected_removal_time'])){
        $selected_removal_time=$_POST['selected_removal_time'];
        $userMealEntry=new userMealEntry();
        echo $userMealEntry->removeTodayFoodTime($selected_removal_time);
    }
    if (isset($_POST['datepickerForUserMealConfirmation'])){
        if ($_POST['specificUserConfirmationTime']!==''){
            if (isset($_POST['numberOfSpecificDateConfirmation']) && is_numeric($_POST['numberOfSpecificDateConfirmation'])){
                $sel_time=$_POST['specificUserConfirmationTime'];
                $sel_date=$_POST['datepickerForUserMealConfirmation'];
                $noOfM=$_POST['numberOfSpecificDateConfirmation'];
                $answer='yes';
                if (!$userMealEntry->checkTimeDataExistence($sel_date,$sel_time)){
                    echo $userMealEntry->saveSpecificDateMealStatus($sel_date,$sel_time,$noOfM,$answer);
                }
                else{
                    echo "<h3 class='text-center black-text-color'>Data Already Exist</h3>";
                }

            }
            else{
                echo "No of meal can not be empty and Enter a numeric value";
            }
        }
    }
    if (isset($_POST['deleteId'])) {
        $delId = $_POST['deleteId'];
        if ($userMealEntry->deleteUserMealEntry($delId)) {
            echo http_response_code(200);
        }
        else{
            echo "Not worked";
        }
    }

    if (isset($_POST['action'])) {
        if (($_POST['action'] == 'updateDate') && !empty($_POST['sel_id'])) {
            $selected_date = $_POST['selected_date'];
            $selected_time=$_POST['sel_time'];
            $total_meal=$_POST['total_meal'];
            $tableId = $_POST['sel_id'];
            $spanNoMeal=$_POST['spanNoMeal'];
            if (!$userMealEntry->checkTimeDataExistence($selected_date,$selected_time) || $total_meal!=$spanNoMeal) {
                if ($userMealEntry->updateUserMealEntry($tableId, $selected_date, $total_meal)) {
                    echo http_response_code(200);
                } else {
                    echo "Something Went wrong!";
                }
            } else {
                //var_dump($userMealEntry->checkMealTimeDate($selected_date, $selected_time, $total_meal));
                echo "Already Selected By You!";
            }
            /*if ($total_meal!=$spanNoMeal){

            }*/


        }
    }
}

?>