<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 6/12/2017
 * Time: 10:54 PM
 */

include_once "sessionStartCheck.php";

/*include_once 'DbFile/oodbconfig.php';*/

class shopperSelectionFetch extends oodbconfig
{
    private $month_name;
    private $oodbconfig;
    private $groupId;

    public function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->month_name = date('F');
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
    }

    function set_month_name($month_name)
    {
        $this->month_name = $month_name;
    }

    protected function get_shopping_date()
    {

        $conn = $this->oodbconfig->get_connection();

        $shoppingDateGettingQuery = sprintf("SELECT selected_date,manager_id,selected_person_id 
        from shoppingpersonselection WHERE group_id=%f AND YEAR(selected_date)=YEAR(NOW()) AND MONTHNAME(selected_date)='" . $this->month_name . "'", mysqli_real_escape_string($conn, $this->groupId));

        $shoppingDateResult = $conn->query($shoppingDateGettingQuery);
        if ($conn->affected_rows > 0) {
            echo "<table class='table table-bordered'><thead style='background: rgba(255,62,251,0.19);'><tr><td>Date</td><td>Selected Person</td><td>Manager ID</td></tr></thead>";
            while ($row = $shoppingDateResult->fetch_assoc()) {
                echo "<tbody><tr><td>" . $row['selected_date'] . "</td><td>" . $row['selected_person_id'] . "</td><td>" . $row['manager_id'] . "</td></tr></tbody>";
            }
            echo "</table>";
        } else {
            echo "<tr><td colspan='2'><h3 class='text-center black-text-color'><strong>No Data Available</strong></h3></td></tr>";
        }

    }

    function get_shopping_date_by_id($selected_id)
    {

        $conn = $this->oodbconfig->get_connection();
        $sel_id = $selected_id;
        $shoppingDateGettingQuery = sprintf("SELECT id,selected_date,manager_id,selected_person_id 
            from shoppingpersonselection WHERE group_id=%f and selected_person_id='" . $sel_id . "' 
            AND YEAR(selected_date)=YEAR(NOW()) AND MONTHNAME(selected_date)='" . $this->month_name . "' 
            ORDER BY selected_date", mysqli_real_escape_string($conn, $this->groupId));

        $shoppingDateResult = $conn->query($shoppingDateGettingQuery);
        if ($conn->affected_rows > 0) {
            echo "<table class='table table-bordered'>
                    <thead style='background: rgba(91,240,238,0.59)'>
                        <tr>
                        <th>Selected Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $shoppingDateResult->fetch_assoc()) {
                $changed_date = DateTime::createFromFormat('Y-m-d', $row['selected_date']);
                $specifiedDate = $changed_date->format("d/m/Y");
                echo "<tr id='trId".$row['id']."'>
                            <td>
                                <span class='editSpan selected_date'>" . $specifiedDate . "</span>
                                <input class='editInput selected_date form-control black-text-color' type='text' 
                                name='selected_date' value='".$specifiedDate. "' 
                                style='display: none;border: 2px solid #4a6dff;border-radius: 4px;box-sizing: border-box;' id='" .$row['id']."'>
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
                /* array_push($selected_person_id,$row['selected_person_id']);
                 array_push($selected_date,$row['selected_date']);*/
            }
            echo "</tbody></table>";

            /*$selected_date_data = array('selected_date' =>$selected_date ,'selected_person_id'=>$selected_person_id);
            json_encode($selected_date_data);*/

        } else {
            echo "<tr><td colspan='2'><h3 class='text-center black-text-color'><strong>No Data Available</strong></h3></td></tr>";
        }
    }


    function return_get_shopping_date()
    {
        return $this->get_shopping_date();
    }

}

/*$shopperSelectionFetch=new shopperSelectionFetch();
$shopperSelectionFetch->set_month_name('june');

$shopperSelectionFetch->return_get_shopping_date();
$shopperSelectionFetch->get_shopping_date_by_id(8);*/


?>