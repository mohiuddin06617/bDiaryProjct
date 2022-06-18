<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 01-Jul-17
 * Time: 1:41 PM
 */
include_once "sessionStartCheck.php";
include "DbFile/oodbconfig.php";

class userSpecificDateBazarData extends oodbconfig
{
    private $selected_specific_date;
    private $oodbconfig;
    private $userId;
    private $groupId;
    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->userId=isset($_SESSION['userID'])?$_SESSION['userID']:null;
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
    }

    public function setSelectedSpecificDate($selected_specific_date)
    {
        $date = DateTime::createFromFormat('d/m/Y', $selected_specific_date);
        $selected_specific_date = $date->format('Y-m-d');
        $this->selected_specific_date = $selected_specific_date;

    }
    function specificDateValidation($bazarDate)
    {

        $bazarDateSplit = explode('/', $bazarDate);
        if (count($bazarDateSplit) == 3)
        {
            if (checkdate($bazarDateSplit[1], $bazarDateSplit[0], $bazarDateSplit[2])) {
                $bazarDateListWithCost = implode("/", $bazarDateSplit);
                return $bazarDateListWithCost;
            } else {
                echo "Date is not completely valid";
            }
        } else {
            echo "<h1 class='text-danger text-center'>Please Select a date</h1>";
        }
    }

    function specific_date_bazar_data(){
        $total_amount=array();
        $manager_response=array();
        $total_a=0;
        $conn=$this->oodbconfig->get_connection();
        $specificBazarDetailsQuery="SELECT dailyCostTableId,item_name,item_price,quantity,manager_response from userdailycost WHERE user_id='$this->userId' AND group_id='$this->groupId' AND entry_time_date='".$this->selected_specific_date."'";
        $specificBazarDetailsResult=$conn->query($specificBazarDetailsQuery);
        if ($specificBazarDetailsResult->num_rows>0){
            echo "<table class='table table-bordered'><thead><tr><th>Item Name</th><th>Item Price(BDT)</th><th>Quantity</th><th>Action</th></tr></thead><tbody>";
            while ($row=$specificBazarDetailsResult->fetch_assoc()){
                echo "<tr id='".$row['dailyCostTableId']."'>
                        <td>
                            <span class='editSpan item_name'>".$row['item_name']."</span>
                            <input class='editInput item_name form-control black-text-color' type='text' name='item_name' value='".$row['item_name']."'
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
                            <span class='editSpan item_price'>".$row['item_price']."</span>
                            <input class='editInput item_price form-control black-text-color' type='text' name='item_price' value='".$row['item_price']."'
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
                            <span class='editSpan quantity'>".$row['quantity']."</span>
                            <input class='editInput quantity form-control black-text-color' type='text' name='quantity' value='".$row['quantity']."'
                            style='display: none;border: 2px solid #4bb4ff;border-radius: 4px;box-sizing: border-box;'>
                        </td>
                        <td>
                            <a type='button' class='btn btn-info editBtn' id='".$row['dailyCostTableId']."'>
                                <i class='fa fa-edit'></i> EDIT</a>
                            <a type='button' class='btn btn-danger deleteBtn' id='".$row['dailyCostTableId']."'>
                                <i class='fa fa-trash'></i> Delete</a>
                            <a type='button' class='btn btn-link btn-warning btn-lg btn-getting updateBtn' style='display: none;'>
                                <i class='fa fa-refresh'></i> Update</a>
                            <a type='button' class='btn btn-link btn-danger btn-lg btn-getting cancelBtn' style='display: none;'>
                                <i class='fa fa-times'></i> Cancel</a>
                        </td>
                      </tr>";
                array_push($total_amount,$row['item_price']);
                $total_a=$total_a+$row['item_price'];
                array_push($manager_response,$row['manager_response']);
            }
            echo "</tbody><tfoot><tr><td style='background-color: #00e5ff;font-weight: bolder;'>Total Amount</td>
                                     <td colspan='3' style='background-color: powderblue;font-size: 19px;font-weight: bolder;'>".$total_a." TK</td></tr><tr>";
                            if($manager_response[0]==0 && count(array_unique($manager_response))==1)
                            {
                                echo "<td colspan='4' style='font-size: 18px; background-color: indianred;'><i class='fa fa-window-close-o'></i> Not Approved</td>";
                            }
                            elseif($manager_response[0]==1 && count(array_unique($manager_response))==1)
                            {
                                echo "<td colspan='4' style='font-size: 18px; background-color: #7177ff;font-weight: bolder;'><i class='fa fa-smile-o'></i> Approved And Recorded</td>";
                            }
                            echo "</tr></tfoot></table>";

        }
        else{
            echo "<h1 class='text-danger text-center'>You Have not entered any Bazar Details on selected day </h1>";
        }
    }

}
if ($_SERVER['REQUEST_METHOD']=="POST") {
    if (isset($_POST['bazarDateList']) && !empty($_POST['bazarDateList'])) {
        $userSpecificDateBazarData = new userSpecificDateBazarData();
        $bazarDateListWithCost = $userSpecificDateBazarData->specificDateValidation($_POST['bazarDateList']);
        $userSpecificDateBazarData->setSelectedSpecificDate($bazarDateListWithCost);
        $userSpecificDateBazarData->specific_date_bazar_data();
    }
}
?>