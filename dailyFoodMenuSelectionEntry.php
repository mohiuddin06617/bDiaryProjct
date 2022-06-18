<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 7/4/2017
 * Time: 8:29 PM
 */
include_once "sessionStartCheck.php";
include "DbFile/oodbconfig.php";


class dailyFoodMenuSelectionEntry extends oodbconfig
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
        $this->groupId=$_SESSION['groupID'];
        $this->managerId=$_SESSION['managerID'];
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
}
if ($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['datepickerManagerFoodMenu'])) {
        $dynamic_food_menu = new dailyFoodMenuSelectionEntry();
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
}

?>