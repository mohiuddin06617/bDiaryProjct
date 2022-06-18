<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 7/4/2017
 * Time: 8:29 PM
 */
include_once "sessionStartCheck.php";
include "DbFile/oodbconfig.php";


class managerFoodMenuEntry extends oodbconfig
{


    private $item_list = array();
    private $selected_date;
    private $selected_time;
    private $groupId;
    private $managerId;
    private $oodbconfig;
    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->managerId = isset($_SESSION['managerID']) ? $_SESSION['managerID'] : null;
        $this->groupId = isset($_SESSION['groupID']) ? $_SESSION['groupID'] : null;
    }

    function setSelectedDate($selected_date)
    {
        $this->selected_date = $selected_date;
    }

    public function getSelectedDate()
    {
        return $this->selected_date;
    }

    function setSelectedTime($selected_time)
    {
        $this->selected_time = $selected_time;
    }

    public function getSelectedTime()
    {
        return $this->selected_time;
    }

    function meal_time_validation()
    {
        if ($this->getSelectedTime() == "") {
            return false;
        }
        return true;
    }

    function date_validation()
    {
        $exploded_date = explode('-', $this->selected_date);
        if (!empty($this->selected_date) && !empty($exploded_date[0]) && !empty($exploded_date[1]) && !empty($exploded_date[2])) {
            if (checkdate($exploded_date[1], $exploded_date[2], $exploded_date[0])) {
                implode('-', $exploded_date);
                return true;
            } else {
                $exploded_date = '';
                return false;
            }
        } else {
            return false;
        }
    }

    function item_data_validation()
    {
        $conn=$this->oodbconfig->get_connection();
        foreach ($_POST['itemList'] as $itemList) {
            array_push($this->item_list, $this->validate_input(mysqli_real_escape_string($conn, $itemList)));
        }
        if (in_array('', $this->item_list)) {
            return false;
        } else {
            return true;
        }
    }

    private function validate_input($data)
    {
        $data = strip_tags($data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        $data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return $data;
    }

    function enter_input()
    {
        $conn=$this->oodbconfig->get_connection();

        $selected_date = $this->getSelectedDate();
        $selected_time = $this->getSelectedTime();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($this->meal_time_validation()) {
            if ($this->date_validation()) {
                if ($this->item_data_validation()) {
                    $dailyFoodMenuEntryQuery ="INSERT INTO foodmenu (manager_id,group_id,inserted_date,inserted_time,item_name) VALUES ";
                    $dailyFoodMenuEntry = "";
                    $itemValues = 0;
                    for ($i = 0; $i < count($_POST['itemList']); $i++) {
                        $itemValues++;
                        if ($dailyFoodMenuEntry != "") {
                            $dailyFoodMenuEntry .= ",";
                        }
                        $dailyFoodMenuEntry .= "('$this->managerId','$this->groupId','$selected_date','$selected_time','" . $_POST["itemList"][$i] . "')";
                    }
                    $sql = $dailyFoodMenuEntryQuery . $dailyFoodMenuEntry;
                    if ($itemValues != 0) {
                        $dailyFoodMenuEntryResult = mysqli_query($conn, $sql);
                        if (!empty($dailyFoodMenuEntryResult)) {
                            $message =$selected_date." ". $selected_time." ";
                            $message .= "Menu Added Successfully.";
                        echo "<h3 class='text-center'>".$message."</h3>";
                        }
                        else {
                            echo "Unsucessful" . mysqli_error($conn);
                        }
                    }
                }
            }
        }
    }

    public function deleteFoodMenuData($deleteId)
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $sql = "DELETE from foodmenu WHERE foodmenu.group_id='$this->groupId' AND foodmenu.foodMenuId='$deleteId'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $stat = true;
        }
        return $stat;
    }

    public function updateShoppingData($selected_Id, $item_name, $selected_date)
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $updateQuery = $conn->prepare("Update foodmenu SET foodmenu.item_name=?,foodmenu.inserted_date=?
        WHERE foodmenu.foodMenuId=? AND foodmenu.group_id=?");
        $updateQuery->bind_param('ssii', $item_name, $selected_date, $selected_Id, $this->groupId);
        $result = $updateQuery->execute();
        if ($result) {
            $stat = true;
        }
        return $stat;
    }
}
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $dynamic_food_menu = new managerFoodMenuEntry();
    if (isset($_POST['datepickerManagerFoodMenu'])) {
        $changed_date = DateTime::createFromFormat('d/m/Y', $_POST['datepickerManagerFoodMenu']); //Changing Date into MYSQL Date Format
        $specifiedDate = $changed_date->format("Y-m-d");

        $dynamic_food_menu->setSelectedTime($_POST['time']);
        $dynamic_food_menu->setSelectedDate($specifiedDate);
        if ($dynamic_food_menu->meal_time_validation()) {
            if ($dynamic_food_menu->date_validation()) {
                if ($dynamic_food_menu->item_data_validation()) {
                    $dynamic_food_menu->enter_input();
                } else {
                    echo "<h1>Please Enter Item Name </h1>";
                }
            } else {
                echo "invalid Date";
            }
        } else {
            echo "<h1>Please Select a time</h1>";
        }
    }
    if (isset($_POST['action'])) {
        if (($_POST['action'] == 'deleteData') && !empty($_POST['deleteId'])) {
            $deleteId=isset($_POST['deleteId'])?$_POST['deleteId']:null;
            if ($dynamic_food_menu->deleteFoodMenuData($deleteId)){
                echo http_response_code(200);
            }
            else{
                echo "Some Problem In deleteing! Please Try again Later";
            }

        }
        if (($_POST['action'] === 'updateData') && !empty($_POST['sel_id'])) {
            if (!empty($_POST['item_name']) && !empty($_POST['selected_date'])){
                $selected_id=$_POST['sel_id'];
                $item_name=isset($_POST['item_name'])?$_POST['item_name']:null;
                $selected_date=isset($_POST['selected_date'])?$_POST['selected_date']:null;
                $changed_date = DateTime::createFromFormat('d/m/Y', $selected_date); //Changing Date into MYSQL Date Format
                $selected_date = $changed_date->format("Y-m-d");
                if ($dynamic_food_menu->updateShoppingData($selected_id,$item_name,$selected_date)){
                    echo http_response_code(200);
                }
            }
            else{
                echo "Menu Item or Can not be Empty";
            }
        }
    }
}

?>