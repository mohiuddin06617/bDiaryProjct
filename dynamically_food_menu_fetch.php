<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 06-Jul-17
 * Time: 10:26 AM
 */
include "DbFile/db.php";
include 'sessionStartCheck.php';

class dynamically_food_menu_fetch extends dbPractice{

    private $current_date;
    private $selected_number_of_day;

    private $today=array();

    private $tomorrow=array();
    private $next1day=array();
    private $next2day=array();
    private $next3day=array();
    private $next4day=array();
    private $next5day=array();
    private $next6day=array();
    private $next7day=array();

    private $yesterday=array();
    private $previous2day=array();
    private $previous3day=array();
    private $previous4day=array();
    private $previous5day=array();
    private $previous6day=array();
    private $previous7day=array();


    function __construct() {

    }

    /**
     * @param mixed $current_date
     */
    private function setCurrentDate($current_date)
    {
        $this->current_date = $current_date;
    }

    /**
     * @return mixed
     */
    public function getCurrentDate()
    {
        return $this->current_date;
    }

    /**
     * @param mixed $selected_number_of_day
     */
    public function setSelectedNumberOfDay($selected_number_of_day)
    {
        $this->selected_number_of_day = $selected_number_of_day;
    }

    /**
     * @return mixed
     */

    public function getSelectedNumberOfDay()
    {
        return $this->selected_number_of_day;
    }

    public function divide_same_date_data($allDateData,$selected_num_of_day)
    {
        $todayDate=date('d/m/Y');
        $yesterdayDate=date('d/m/Y',strtotime($todayDate."-1 days"));
        $twoDaysAgoDate=date('d/m/Y',strtotime($todayDate."-2 days"));
        $threeDaysAgoDate=date('d/m/Y',strtotime($todayDate."-3 days"));
        $fourDaysAgoDate=date('d/m/Y',strtotime($todayDate."-4 days"));
        $fiveDaysAgoDate=date('d/m/Y',strtotime($todayDate."-5 days"));
        $sixDaysAgoDate=date('d/m/Y',strtotime($todayDate."-6 days"));
        $sevenDaysAgoDate=date('d/m/Y',strtotime($todayDate."-7 days"));

        $tomorrowDate = date('d/m/Y',strtotime($todayDate."+1 days"));
        $next2DaysDate=date('d/m/Y',strtotime($todayDate."+2 days"));
        $next3DaysDate=date('d/m/Y',strtotime($todayDate."+3 days"));
        $next4DaysDate=date('d/m/Y',strtotime($todayDate."+4 days"));
        $next5DaysDate=date('d/m/Y',strtotime($todayDate."+5 days"));
        $next6DaysDate=date('d/m/Y',strtotime($todayDate."+6 days"));
        $next7DaysDate=date('d/m/Y',strtotime($todayDate."+7 days"));

        if ($selected_num_of_day<7){
           echo array_search($todayDate,$allDateData,true);
           echo array_search($yesterdayDate,$allDateData,true);

        }
        elseif($selected_num_of_day>7){
            print_r($allDateData);
        }

        echo "Today : ".print_r($this->today)."<br>";
        echo "Yesterday : ".print_r($this->yesterday)."<br>";
        echo "Previous 2 Day : ".print_r($this->previous2day)."<br>";
        echo "Previous 3 Day : ".print_r($this->previous3day)."<br>";
        echo "Previous 4 Day : ".print_r($this->previous4day)."<br>";
        echo "Previous 5 Day : ".print_r($this->previous5day)."<br>";
    }

    public function today_food_menu(){
        $conn=new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        $this->setCurrentDate(date('d/m/Y'));
        $current_date=$this->getCurrentDate();
        $exploded_current_date=explode('/',$current_date);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
/*        if (checkdate($exploded_current_date[1],$exploded_current_date[0],$exploded_current_date[2]){*/

        $gettingTodaysFoodMenuQuery = "SELECT inserted_date,inserted_time,item_name from foodmenu WHERE manager_id='" . $_SESSION['managerID'] . "' AND group_id='" . $_SESSION['groupID'] . "' AND inserted_date='" . $current_date . "'";

        $todaysFoodMenuResult = $conn->query($gettingTodaysFoodMenuQuery);
        if ($todaysFoodMenuResult->num_rows > 0) {
            echo "<table class='table table-bordered'><tr><th>Inserted Date</th><th>Inserted Time</th><th>Item Name</th></tr>";
            while ($row = $todaysFoodMenuResult->fetch_assoc()) {
                echo "<tr><td>".$row['inserted_date']."</td><td>".$row['inserted_time']."</td><td> ". $row['item_name'] . "</td></tr><br>";
            }
            echo "</table>";
        }

    else{
            echo "<h3 class='text-danger'>No Entry Entered Today</h3>";
        }
    }

    public function get_all_selected_days_data($number_of_day){

        $conn=new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $this->setCurrentDate(date('d/m/Y'));
        $curr_date=$this->getCurrentDate();
        $exploded_curr_date=explode('/',$curr_date);
        $selected_date=0;
        $selected_till_date=0;
        $same_date=array();
        if($number_of_day<7) {
            $selected_till_date = 7- $number_of_day;
            $selected_date=date('d/m/Y',strtotime($curr_date."-$selected_till_date days"));

            $allSelectedDaysFoodMenuQuery = "SELECT inserted_date,inserted_time,item_name from foodmenu WHERE manager_id='" . $_SESSION['managerID'] . "' AND group_id='" . $_SESSION['groupID'] . "' AND inserted_date BETWEEN '".$selected_date."' AND '".$curr_date."' ORDER BY inserted_date DESC";

        }
        elseif($number_of_day>7){
            $selected_till_date = $number_of_day-7;
            $selected_date=date('d/m/Y',strtotime($curr_date."+$selected_till_date days"));
            $allSelectedDaysFoodMenuQuery = "SELECT inserted_date,inserted_time,item_name from foodmenu WHERE manager_id='" . $_SESSION['managerID'] . "' AND group_id='" . $_SESSION['groupID'] . "' AND inserted_date BETWEEN '".$curr_date."' AND '".$selected_date."' ORDER BY inserted_date";
        }


        $allSelectedDaysFoodMenuResult = $conn->query($allSelectedDaysFoodMenuQuery);
        if ($allSelectedDaysFoodMenuResult->num_rows > 0) {
            echo "<table class='table table-bordered'><tr><th>Inserted Date</th><th>Inserted Time</th><th>Item Name</th><th>ACTION</th></tr>";
            while ($row = $allSelectedDaysFoodMenuResult->fetch_assoc()) {
                echo "<tr><td>".$row['inserted_date']."</td><td> ". $row['inserted_time']."</td><td> ". $row['item_name'] . "</td><td><button class='btn btn-warning btn-block'>EDIT</button></td></tr>";
                //$this->divide_same_date_data($row,$number_of_day);
            }
            echo "</table>";
        }
        else{
        echo "0 Rows Found!";
        }
    }
    public function specific_date_food_menu($specifiedDate){
        $conn=new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $specifiedDateFoodMenuQuery="SELECT inserted_time,item_name from foodmenu WHERE manager_id='".$_SESSION['managerID']."' AND group_id='".$_SESSION['groupID']."' and inserted_date='".$specifiedDate."' ORDER BY inserted_time";
        $specifiedDateFoodMenuResult=$conn->query($specifiedDateFoodMenuQuery);
        if ($specifiedDateFoodMenuResult->num_rows>0) {
            echo "<table class='table table-bordered'><tr><th>Inserted Time</th><th>Item Name</th><th>ACTION</th></tr>";
            while ($row = $specifiedDateFoodMenuResult->fetch_assoc()) {
                echo "<tr><td>" . $row['inserted_time'] . "</td><td> " . $row['item_name'] . "</td><td><button class='btn btn-info btn-block'>EDIT</button></td></tr>";
            }
                echo '</table>';

        }
        else{
            echo "<h3 class='text-center text-danger'>You have entered data entered on selected day! <i class='ti ti-face-sad'></i></h3>";
        }
    }

}
$dynamically_food_menu_fetch=new dynamically_food_menu_fetch();
if (isset($_POST['selectedNoOfDayToSawFoodMenu'])) {
    if ($_POST['selectedNoOfDayToSawFoodMenu'] == '7') {
        echo "Calling the todays_food-menu";
        $dynamically_food_menu_fetch->today_food_menu();
    } else {
        $dynamically_food_menu_fetch->get_all_selected_days_data($_POST['selectedNoOfDayToSawFoodMenu']);
    }
    $_POST['specificDateFoodMenu']='';
}
elseif(isset($_POST['specificDateFoodMenu'])){
    $_POST['selectedNoOfDayToSawFoodMenu']='';
    $dynamically_food_menu_fetch->specific_date_food_menu($_POST['specificDateFoodMenu']);
}
//$dynamically_food_menu_fetch->divide_same_date_data('Hello','5');
/*echo $_POST['selectedNumberOfDay'];*/



//$dynamically_food_menu_fetch->get_all_selected_days_data(11);

?>