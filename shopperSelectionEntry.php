<?php
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class shopperSelectionEntry extends oodbconfig
{
    private $oodbconfig;
    private $groupId;
    private $managerId;

    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->groupId = isset($_SESSION['groupID']) ? $_SESSION['groupID'] : null;
        $this->managerId = isset($_SESSION['managerID']) ? $_SESSION['managerID'] : null;
    }

    public function shopperSelectedEntry($selectedPersonId, $newFormattedDate)
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $entryQuery = "INSERT INTO shoppingPersonSelection(manager_id,group_id,selected_person_id,selected_date)
                VALUES ('$this->managerId','$this->groupId','$selectedPersonId','$newFormattedDate')";
        $executeQuery = mysqli_query($conn, $entryQuery);
        if ($conn->affected_rows > 0) {
            $stat = true;
        }

        return $stat;
    }

    public function shopperDuplicationCheck($newFormattedDate)
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $sqlDateDuplicateCheck = "SELECT selected_date from shoppingpersonselection WHERE group_id='$this->groupId' AND selected_date='$newFormattedDate'";
        $result = mysqli_query($conn, $sqlDateDuplicateCheck);
        if ($conn->affected_rows > 0) {
            $stat = true;
        }
        return $stat;
    }

    public function deleteShoppingEntry($selected_id)
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $sql = "delete from shoppingPersonSelection WHERE group_id='$this->groupId' AND id='$selected_id'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $stat = true;
        }

        return $stat;
    }
    public function updateShopperEntry($sel_id,$selected_date){
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $updateQuery=$conn->prepare("Update shoppingPersonSelection SET shoppingPersonSelection.manager_id=?,
           shoppingPersonSelection.selected_date=? WHERE shoppingPersonSelection.id=? AND shoppingPersonSelection.group_id=?");
        $updateQuery->bind_param('isii',$this->managerId,$selected_date,$sel_id,$this->groupId);
        if ($updateQuery->execute()) {
            if ($updateQuery->affected_rows>0){
                $stat=true;
            }
        }
        return $stat;
    }
}

function formatDate($selectedDateString)
{
    $changed_date = DateTime::createFromFormat('d/m/Y', $selectedDateString);
    $newFormattedDate = $changed_date->format("Y-m-d");
    return $newFormattedDate;
}

if (!empty($_SESSION['email'])) {
    $shopperSelectionEntry = new shopperSelectionEntry();
    if (isset($_POST['selectedDateForShopper'])) {
        $selectedPersonId = $_POST['selectedShopper'];
        $selectedDateString = $_POST['selectedDateForShopper'];
        $newFormattedDate = formatDate($selectedDateString);

        if (empty($selectedDateString)) {
            echo "<h2>Please select a date</h2>";
        } else {

            if ($shopperSelectionEntry->shopperDuplicationCheck($newFormattedDate)) {
                echo "This date shopping person already been entered by you";
            } else {
                if ($shopperSelectionEntry->shopperSelectedEntry($selectedPersonId, $newFormattedDate)) {
                    echo "<h3 class='black-text-color'>Selected User Will be Notified About Shopping!</h3>";
                } else {
                    echo "<h3 class='text-center black-text-color'>Something Wrong!! </h3>";
                }
            }
        }
    }
    if (isset($_POST['deleteId'])) {
        $delId = $_POST['deleteId'];
        if ($shopperSelectionEntry->deleteShoppingEntry($delId)) {
            echo http_response_code(200);
        }
    }
    if (isset($_POST['action'])) {
        if (($_POST['action'] == 'updateDate') && !empty($_POST['sel_id'])) {
            $selected_date = formatDate($_POST['selected_date']);
            $sel_id = $_POST['sel_id'];
            if ($shopperSelectionEntry->shopperDuplicationCheck($selected_date)) {
                echo "Selected Date already has a shopper";
            } else {
                if ($shopperSelectionEntry->updateShopperEntry($sel_id, $selected_date)) {
                    echo http_response_code(200);
                } else {
                    echo "something Went wrong!";
                }
            }
            //echo $selected_date." ".$sel_id;
        }
    }

} else {
    header("Location:logout.php");
}
?>
