<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 16-Jun-17
 * Time: 8:12 AM
 */
include_once "sessionStartCheck.php";
include_once 'DbFile/oodbconfig.php';

class userShoppingDateFetch extends oodbconfig
{
    private $month_name;
    private $sel_id;
    private $group_member_name = array();
    private $group_members_id = array();
    private $oodbconfig;

    function __construct()
    {
        $this->month_name = date('F');
        $sel_id = isset($_SESSION['userID'])?$_SESSION['userID']:null;
        $this->oodbconfig = new oodbconfig();
    }

    function set_month_name($month_name)
    {
        $this->month_name = $month_name;
    }

    function user_next_shopping_date($selected_id)
    {
        /*Getting All Date Value*/

        $conn = $this->oodbconfig->get_connection();
        $shoppingDateGettingQuery = "SELECT selected_date,manager_id,selected_person_id  
        from shoppingpersonselection WHERE selected_person_id='" . $selected_id . "' AND manager_id =(SELECT manager_id from groupDetails where group_id='" . $_SESSION['groupID'] . "') AND YEAR(selected_date)=YEAR(NOW()) AND MONTHNAME(selected_date)='" . $this->month_name . "'";
        $dateData = array();
        $shoppingDateResult = $conn->query($shoppingDateGettingQuery);
        $numberOfRows = $shoppingDateResult->num_rows;
        if ($numberOfRows > 0) {
            while ($row = $shoppingDateResult->fetch_assoc()) {
                array_push($dateData, $row['selected_date']);
            }
            $todaysDate = date('Y-m-d');
            foreach ($dateData as $date) {
                //$interval[$count] = abs(strtotime($date) - strtotime($day));
                $interval[] = abs(strtotime($todaysDate) - strtotime($date));
                //$count++;
            }
            asort($interval);
            $closest = key($interval);

            return $this->formatDate($dateData[$closest]);
        } else {
            return null;
        }
    }

    function formatDate($change_date){
        $changed_date = DateTime::createFromFormat('Y-m-d', $change_date);
        $newFormattedDate = $changed_date->format("d/m/Y");
        return $newFormattedDate;
    }
    function user_shopping_list($selected_id)
    {
        $conn = $this->oodbconfig->get_connection();
        $shoppingDateGettingQuery = "SELECT selected_date,manager_id,selected_person_id,bazar_status  
        from shoppingpersonselection WHERE selected_person_id='" . $selected_id . "' AND manager_id =(SELECT manager_id from groupDetails where group_id='" . $_SESSION['groupID'] . "') AND YEAR(selected_date)=YEAR(NOW()) AND MONTHNAME(selected_date)='" . $this->month_name . "' ORDER BY selected_date";
        $dateData = array();
        $shoppingDateResult = $conn->query($shoppingDateGettingQuery);

        if ($shoppingDateResult->num_rows > 0) {
            while ($row = $shoppingDateResult->fetch_assoc()) {
                echo "<tr>
                        <td>" . $this->formatDate($row['selected_date']) . "</td>
                        <td>";
                if ($row['bazar_status']==1) {
                    echo "<button class='btn btn-success btn-getting'>
                            <i class='fa fa-check fa-lg' aria-hidden='true'></i> Shopping Complete</button>";
                }
                elseif ($row['bazar_status']==0){
                    echo "<a type='button' href='userShoppingCost.php' class='btn btn-danger btn-getting'>
                            <i class='fa fa-times' aria-hidden='true'></i> Shopping Not Complete</a>";
                }
                echo "</td>
                      </tr>";

            }
        } else {
            echo "<tr class='text-center'><h3 class='text-center black-text-color'>No Bazar Date to show</h3></tr>";

        }
    }
    function userSpecificMonthShoppingList($selectedMonth){
        $conn = $this->oodbconfig->get_connection();
        $selected_id=$_SESSION['userID'];
        $groupId=$_SESSION['groupID'];
        $shoppingDateGettingQuery = "SELECT selected_date,manager_id,selected_person_id,bazar_status  
        from shoppingpersonselection WHERE selected_person_id='" . $selected_id . "' AND manager_id =(SELECT manager_id from groupDetails where group_id='" . $groupId . "') AND YEAR(selected_date)=YEAR(NOW()) AND MONTH(selected_date)='" . $selectedMonth . "' ORDER BY selected_date";
        $dateData = array();
        $shoppingDateResult = $conn->query($shoppingDateGettingQuery);
        if ($shoppingDateResult->num_rows > 0) {
            while ($row = $shoppingDateResult->fetch_assoc()) {
                echo "<tr>
                        <td><b>" .$this->formatDate( $row['selected_date']) . "</b></td>
                        <td>";
                if ($row['bazar_status']==1) {
                    echo "<button class='btn btn-success btn-getting'>
                            <i class='fa fa-check fa-lg' aria-hidden='true'></i> Shopping Complete</button>";
                }
                elseif ($row['bazar_status']==0){
                    echo "<a type='button' href='userShoppingCost.php' class='btn btn-danger btn-getting'>
                            <i class='fa fa-times' aria-hidden='true'></i> Shopping Not Complete</a>";
                }
                 echo "</td>
                      </tr>";

            }
        } else {
            echo "<tr><td colspan='2'><h3 class='text-center black-text-color'>No Bazar Date to show</h3></td></tr>";

        }
    }

    function group_members_bazar_date_list($selected_id)
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $shoppingDateGettingQuery = "SELECT selected_date,manager_id,selected_person_id,bazar_status  
        from shoppingpersonselection WHERE selected_person_id='" . $selected_id . "' AND manager_id =(SELECT manager_id from groupDetails where group_id='" . $_SESSION['groupID'] . "') AND YEAR(selected_date)=YEAR(NOW()) AND MONTHNAME(selected_date)='" . $this->month_name . "' ORDER BY selected_date";
        $dateData = array();
        $shoppingDateResult = $conn->query($shoppingDateGettingQuery);

        if ($shoppingDateResult->num_rows > 0) {
            while ($row = $shoppingDateResult->fetch_assoc()) {
                echo "<tr><td>" . $this->formatDate( $row['selected_date']) . "</td>";
                if ($row['bazar_status'] == 0) {
                    echo "<td><button class='btn btn-danger btn-getting btn-block'>
                <i class='fa fa-window-close fa-lg' aria-hidden='true'></i> Not Done</button></td></tr>";
                } elseif ($row['bazar_status'] == 1) {
                    echo "<td><button class='btn btn-success btn-getting btn-block'>
                <i class='fa fa-check fa-lg' aria-hidden='true'></i> Done</button></td></tr>";
                }
            }
        } else {
            echo "<h3 class='text-center black-text-color'>No Bazar Date to show</h3>";
        }
    }

    function return_group_members_name($group_id)
    {
        return $this->group_members_name_list($group_id);
    }

    protected function group_members_name_list($group_id)
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $membersNameQuery = sprintf("SELECT id,firstName,lastName from userinfo WHERE group_id=%f", mysqli_real_escape_string($conn, $group_id));
        $membersNameResult = $conn->query($membersNameQuery);
        if ($membersNameResult->num_rows > 0) {
            while ($row = $membersNameResult->fetch_assoc()) {
                array_push($this->group_member_name, mysqli_real_escape_string($conn, $row['firstName'] . " " . $row['lastName']));
                array_push($this->group_members_id, mysqli_real_escape_string($conn, $row['id']));
            }
        }
        return $this->group_member_name;
    }

    function return_group_member_id()
    {
        return $this->group_members_id;
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['selectedMonthVal'])) {
        $selectedMonthVal = $_POST['selectedMonthVal'];
        $userShoppingDateDetails = new userShoppingDateFetch();
        $userShoppingDateDetails->userSpecificMonthShoppingList($selectedMonthVal);
    }
}
?>

