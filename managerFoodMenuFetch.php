<?php
/**
 * Created by PhpStorm.
 * User: Mohiuddin
 * Date: 8/1/2017
 * Time: 10:17 AM
 */

include_once "sessionStartCheck.php";
include_once 'DbFile/oodbconfig.php';

class managerFoodMenuFetch extends oodbconfig
{
    private $current_date;
    private $selected_number_of_day;
    private $json_food_menu_array = array();
    private $all_food_menu_list = array();
    private $specificDateFoodMenuList = array();
    private $todayBreakfastFoodMenuList = array();
    private $todayLunchFoodMenuList = array();
    private $todayDinnerFoodMenuList = array();
    private $managerId;
    private $groupId;
    private $oodbconfig;

    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->managerId = isset($_SESSION['managerID']) ? $_SESSION['managerID'] : null;
        $this->groupId = isset($_SESSION['groupID']) ? $_SESSION['groupID'] : null;
        //$this->setTodayBreakfastFoodMenu();
        //$this->setTodayLunchFoodMenu();
        //$this->setTodayDinnerFoodMenu();
    }

    public function enocoding_today_food_menu()
    {
        $this->today_food_menu();
        if (!empty($this->json_food_menu_array)) {

            return json_encode($this->json_food_menu_array);
        } else {
            return "Empty Data";
        }
    }

    private function today_food_menu()
    {
        $conn = $this->oodbconfig->get_connection();
        $this->setCurrentDate(date('Y-m-d'));
        $current_date = $this->getCurrentDate();
        $gettingTodaysFoodMenuQuery = $conn->prepare("SELECT foodMenuId,inserted_date,inserted_time,item_name from foodmenu WHERE group_id=? AND inserted_date=?") or die($conn->errno);
        $gettingTodaysFoodMenuQuery->bind_param('ds', $this->groupId, $current_date);
        $gettingTodaysFoodMenuQuery->execute();

        $todaysFoodMenuResult = $gettingTodaysFoodMenuQuery->get_result();

        if ($todaysFoodMenuResult->num_rows > 0) {
            while ($row = $todaysFoodMenuResult->fetch_assoc()) {
                $changed_date = DateTime::createFromFormat('Y-m-d', $row['inserted_date']);
                $row['inserted_date'] = $changed_date->format("d/m/Y");
                array_push($this->json_food_menu_array, $row);
            }
        }
    }

    public function setTodayBreakfastFoodMenu()
    {
        $conn = $this->oodbconfig->get_connection();
        $curr_date = date('Y-m-d');
        $sql = "SELECT foodMenuId,inserted_date,inserted_time,item_name from foodmenu WHERE group_id='$this->groupId' AND inserted_date='$curr_date' AND inserted_time='Breakfast'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['foodMenuId'];
                $item = $row['item_name'];
                echo "<tr id='$id'>
                        <td>
                            <span class='editSpan item_name'>" . $item . "</span>
                            <input class='editInput item_name form-control black-text-color' type='text' 
                            name='item_name' value='" . $item . "' 
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
                            <span class='editSpan selected_date'>" . date('d/m/Y') . "</span>
                            <input class='editInput selected_date form-control black-text-color' type='text' 
                            name='selected_date' value='" . date('d/m/Y') . "' 
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
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
                /*array_push($this->todayBreakfastFoodMenuList, $item_name);*/
            }
        } else {
            echo "<tr><td colspan='3'><strong>No Food Menu Entered</strong></td></tr>";
        }
    }

    public function setTodayLunchFoodMenu()
    {
        $conn = $this->oodbconfig->get_connection();
        $curr_date = date('Y-m-d');
        $sql = "SELECT foodMenuId,inserted_date,inserted_time,item_name from foodmenu WHERE group_id='$this->groupId' AND inserted_date='$curr_date' AND inserted_time='Lunch'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['foodMenuId'];
                $item = $row['item_name'];
                echo "<tr id='$id'>
                        <td>
                            <span class='editSpan item_name'>" . $item . "</span>
                            <input class='editInput item_name form-control black-text-color' type='text' 
                            name='item_name' value='" . $item . "' 
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
                            <span class='editSpan selected_date'>" . date('d/m/Y') . "</span>
                            <input class='editInput selected_date form-control black-text-color' type='text' 
                            name='selected_date' value='" . date('d/m/Y') . "' 
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
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
                /*array_push($this->todayBreakfastFoodMenuList, $item_name);*/
            }
        } else {
            echo "<tr><td colspan='3'><strong>No Food Menu Entered</strong></td></tr>";
        }

    }

    public function setTodayDinnerFoodMenu()
    {
        $conn = $this->oodbconfig->get_connection();
        $curr_date = date('Y-m-d');
        $sql = "SELECT foodMenuId,inserted_date,inserted_time,item_name from foodmenu WHERE group_id='$this->groupId' AND inserted_date='$curr_date' AND inserted_time='Dinner'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['foodMenuId'];
                $item = $row['item_name'];
                echo "<tr id='$id'>
                        <td>
                            <span class='editSpan item_name'>" . $item . "</span>
                            <input class='editInput item_name form-control black-text-color' type='text' 
                            name='item_name' value='" . $item . "' 
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
                            <span class='editSpan selected_date'>" . date('d/m/Y') . "</span>
                            <input class='editInput selected_date form-control black-text-color' type='text' 
                            name='selected_date' value='" . date('d/m/Y') . "' 
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
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
                /*array_push($this->todayBreakfastFoodMenuList, $item_name);*/
            }
        } else {
            echo "<tr><td colspan='3'><strong>No Food Menu Entered</strong></td></tr>";
        }

    }

    private function setCurrentDate($current_date)
    {
        $this->current_date = $current_date;
    }


    private function get_all_selected_days_data($number_of_day)
    {
        $conn = $this->oodbconfig->get_connection();
        $this->setCurrentDate(date('Y-m-d'));
        $curr_date = $this->getCurrentDate();
        $selected_date = 0;
        $all_data = array();
        $allSelectedDaysFoodMenuQuery = '';
        //past 7 days listed food menu
        if ($number_of_day < 7) {
            $selected_till_date = 7 - $number_of_day;
            $selected_date = date('Y-m-d', strtotime("-$selected_till_date days"));
            $allSelectedDaysFoodMenuQuery = $conn->prepare("SELECT foodMenuId,inserted_date,inserted_time,item_name from foodmenu WHERE group_id=? AND inserted_date >=? AND inserted_date<=? ORDER BY inserted_date");
            $allSelectedDaysFoodMenuQuery->bind_param('dss', $this->groupId, $selected_date, $curr_date);
            $allSelectedDaysFoodMenuQuery->execute();
        } // future 7 days food menu
        elseif ($number_of_day > 7) {
            $selected_till_date = $number_of_day - 7;
            $selected_date = date('Y-m-d', strtotime("+$selected_till_date days"));
            $allSelectedDaysFoodMenuQuery = $conn->prepare("SELECT foodMenuId,inserted_date,inserted_time,item_name from foodmenu WHERE group_id=? AND inserted_date >=? AND inserted_date<=? ORDER BY inserted_date");
            $allSelectedDaysFoodMenuQuery->bind_param('dss', $this->groupId, $curr_date, $selected_date);
            $allSelectedDaysFoodMenuQuery->execute();
        }
        $allSelectedDaysFoodMenuResult = $allSelectedDaysFoodMenuQuery->get_result();
        if ($allSelectedDaysFoodMenuResult->num_rows > 0) {
            $row_array = array();
            /*            echo "<table class='table table-bordered'><tr><th>Inserted Date</th><th>Inserted Time</th><th>Item Name</th><th>ACTION</th></tr>";*/
            while ($row = $allSelectedDaysFoodMenuResult->fetch_assoc()) {
                //$this->divide_same_date_data($row,$number_of_day);
                $changed_date = DateTime::createFromFormat('Y-m-d', $row['inserted_date']);
                $row['inserted_date'] = $changed_date->format("d/m/Y");
                $specifiedDate = $changed_date->format("d/m/Y");
                $row_array['foodMenuId'] = $row['foodMenuId'];
                $row_array['inserted_date'] = $specifiedDate;
                $row_array['inserted_time'] = $row['inserted_time'];
                $row_array['item_name'] = $row['item_name'];
                array_push($this->all_food_menu_list, $row);
            }
        }
    }


    private function specific_date_food_menu($specifiedDate)
    {
        $conn = $this->oodbconfig->get_connection();

        $changed_date = DateTime::createFromFormat('d/m/Y', $specifiedDate);
        $specifiedDate = $changed_date->format("Y-m-d");

        $specifiedDateFoodMenuQuery = $conn->prepare("SELECT foodMenuId,inserted_date,inserted_time,item_name from foodmenu WHERE group_id=? and inserted_date=? ORDER BY inserted_time DESC");
        $specifiedDateFoodMenuQuery->bind_param("is", $this->groupId, $specifiedDate);
        $specifiedDateFoodMenuQuery->execute();
        $specifiedDateFoodMenuResult = $specifiedDateFoodMenuQuery->get_result();
        if ($specifiedDateFoodMenuResult->num_rows > 0) {
            $row_array = array();
            while ($row = $specifiedDateFoodMenuResult->fetch_assoc()) {
                $changed_date = DateTime::createFromFormat('Y-m-d', $row['inserted_date']);
                $specifiedDate = $changed_date->format("d/m/Y");
                $row_array['foodMenuId'] = $row['foodMenuId'];
                $row_array['inserted_date'] = $specifiedDate;
                $row_array['inserted_time'] = $row['inserted_time'];
                $row_array['item_name'] = $row['item_name'];
                array_push($this->specificDateFoodMenuList, $row_array);
            }

        } /*else {
           $val=;
           array_push($this->specificDateFoodMenuList,$val);
        }*/
    }


    private function setSelectedNumberOfDay($selected_number_of_day)
    {
        $this->selected_number_of_day = $selected_number_of_day;
    }

    public function getCurrentDate()
    {
        return $this->current_date;
    }

    public function getSpecificDateFoodMenu($specificDate)
    {
        $this->specific_date_food_menu($specificDate);
        return json_encode($this->specificDateFoodMenuList);
    }

    public function getAllFoodMenuList($num_of_day)
    {
        $this->get_all_selected_days_data($num_of_day);
        return json_encode($this->all_food_menu_list);
    }

    public function getSelectedNumberOfDay()
    {
        return $this->selected_number_of_day;
    }

    public function getTodayBreakfastFoodMenuList()
    {
        return $this->todayBreakfastFoodMenuList;
    }

    public function getTodayLunchFoodMenuList()
    {
        return $this->todayLunchFoodMenuList;
    }

    public function getTodayDinnerFoodMenuList()
    {
        return $this->todayDinnerFoodMenuList;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $foodMenu = new managerFoodMenuFetch();
    $dbconfig = new oodbconfig();
    $conn = $dbconfig->get_connection();
    if (isset($_POST['selectedNoOfDayToSawFoodMenu'])) {
        $selectedNoOfDayToSawFoodMenu = mysqli_real_escape_string($conn, $_POST['selectedNoOfDayToSawFoodMenu']);
        if ($selectedNoOfDayToSawFoodMenu == 7) {
            echo $foodMenu->enocoding_today_food_menu();
        } elseif ($selectedNoOfDayToSawFoodMenu !== 7) {
            echo $foodMenu->getAllFoodMenuList($selectedNoOfDayToSawFoodMenu);
        }
    } elseif (isset($_POST['specificDateFoodMenu'])) {
        $specificDateFoodMenu = mysqli_real_escape_string($conn, $_POST['specificDateFoodMenu']);
        echo $foodMenu->getSpecificDateFoodMenu($specificDateFoodMenu);
    }
}

?>