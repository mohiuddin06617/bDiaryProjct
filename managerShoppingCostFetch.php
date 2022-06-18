<?php
/**
 * Created by PhpStorm.
 * User: Mohiuddin
 * Date: 8/12/2017
 * Time: 4:23 PM
 */
//require "accessRestriction.php";
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class managerShoppingCostFetch extends oodbconfig
{

    private $oodbconfig;
    private $bazar_list_status;
    private $shopper_name;
    private $changed_shopper;
    private $shopper_id;
    private $managerId;
    private $groupId;
    private $todayBazarList;
    private $todayTotalBazarCost;
    private $currentMonthBazarDetails;
    private $nextShopperName;
    private $currentMonthTotalBazarCost;
    private $specificDateBazarDataList=array();


    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->managerId=isset($_SESSION['managerID'])?$_SESSION['managerID']:null;
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->check_bazar_status();
        $this->shopperName();
        $this->setTodayBazarList();
        $this->bazarList();
        $this->setNextShopperName();

    }


    private function check_bazar_status()
    {
        $conn = $this->oodbconfig->get_connection();
        $today = date('Y-m-d');

        /*$gettingTodaysDataQuery = $conn->prepare("SELECT group_id,selected_person_id,selected_date,bazar_status from shoppingpersonselection where manager_id=? AND group_id=? AND selected_date=?");
        $gettingTodaysDataQuery->bind_param('dds', $_SESSION['managerID'], $_SESSION['groupID'], $today);
        $gettingTodaysDataQuery->execute();
        $result = $gettingTodaysDataQuery->get_result();*/
        $gettingTodaysDataQuery = "SELECT group_id,selected_person_id,selected_date,bazar_status 
        from shoppingpersonselection where manager_id='$this->managerId' AND group_id='$this->groupId' AND selected_date='$today'";
        $result = $conn->query($gettingTodaysDataQuery);
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $this->shopper_id = $row['selected_person_id'];
                    $this->bazar_list_status = $row['bazar_status'];
                }
            } else {
                $this->bazar_list_status = "";
            }
        }
    }

    private function shopperName()
    {
        $conn = $this->oodbconfig->get_connection();
        if (!empty($this->shopper_id)) {
            $shopperId = $this->shopper_id;
        }
        $gettingTodaysShopperName = $conn->prepare("SELECT firstName,lastName from userinfo WHERE id=?") or die($conn->errno);
        $gettingTodaysShopperName->bind_param('d', $shopperId);
        $gettingTodaysShopperName->execute();
        $todaysShopperName = $gettingTodaysShopperName->get_result();
        while ($row = $todaysShopperName->fetch_assoc()) {
            $this->shopper_name = ucwords($row['firstName'] . " " . $row['lastName']);
        }
    }

    private function setTodayBazarList()
    {
        $conn = $this->oodbconfig->get_connection();
        $today = date('Y-m-d');
        $query = "select entry_time_date,item_name,item_price,quantity,manager_response from userdailycost
                  WHERE manager_id='$this->managerId' and group_id='$this->groupId' and entry_time_date='$today'";
        $result = $conn->query($query);
        if ($result) {
            if ($result->num_rows > 0) {
                $total = 0;
                while ($row = $result->fetch_assoc()) {
                    $this->todayBazarList .= "<tr>
                                                <td>" . $row['item_name'] . "</td>
                                                <td>" . $row['item_price'] . "</td>
                                                <td>
                                                    <button class=\"btn btn-success btn-getting\">
                                                       <i class=\"fa fa-edit fa-lg\" aria-hidden=\"true\"></i> Edit
                                                    </button>
                                                </td>
                                              </tr>";
                    $total = $total + $row['item_price'];
                }
                $this->todayTotalBazarCost = $total;
            }
        }
    }

    private function bazarList()
    {
        $conn = $this->oodbconfig->get_connection();
        $query = "SELECT entry_time_date,user_id,SUM(item_price) AS 'item_p'
                  from userdailycost WHERE group_id='$this->groupId'
                   AND MONTH(entry_time_date)=MONTH(CURDATE()) GROUP BY entry_time_date";

        $result = $conn->query($query);
        if ($result) {
            if ($result->num_rows > 0) {
                $total = 0;
                while ($row = $result->fetch_assoc())
                {
                    $changedDate=$this->formatDate($row['entry_time_date']);

                    $this->currentMonthBazarDetails .= "<tr id='".$row['entry_time_date']."'>
                                                        <td>
                                                            <p class='chat-right-text'>" . $changedDate . "</p>
                                                        </td>
                                                        <td>
                                                            <p>" . $row['item_p'] . "</p>
                                                        </td>
                                                        <td>
                                                            <p class='specificShpopperName'>" . $this->specifiedUserName($row['user_id'] ). "</p>
                                                        </td>
                                                        <td>
                                                            <button class='btn btn-info showSpecificBazarDetails' id='".$row['entry_time_date']."'>
                                                                <i class='fa fa-info-circle'></i> Details</button>
                                                            <button class='btn btn-danger deleteSpecificBazarDetails' id='".$row['entry_time_date']."'>
                                                                <i class='fa fa-trash-o'></i> Delete</button>
                                                        </td>
                                                    </tr>";
                    $total = $total + $row['item_p'];
                }
                $this->currentMonthTotalBazarCost = $total;
            }
            else{
                $this->currentMonthBazarDetails.="<tr><td colspan='4'><h3>No Data Available</h3></td></tr>";
            }

        }
    }


    public function specificBazarDateData($specifiedDate)
    {
        $conn = $this->oodbconfig->get_connection();

        $changed_date = DateTime::createFromFormat('d/m/Y', $specifiedDate);
        $specifiedDate = $changed_date->format("Y-m-d");

        $specifiedDateFoodMenuQuery = "SELECT dailyCostTableId,item_name,item_price,quantity,manager_response from userdailycost WHERE 
                                      group_id='$this->groupId' and entry_time_date='$specifiedDate' ORDER BY entry_time_date DESC";
        $specifiedDateFoodMenuResult = $conn->query($specifiedDateFoodMenuQuery);
        if ($specifiedDateFoodMenuResult->num_rows > 0) {
            $row_array = array();
            while ($row = $specifiedDateFoodMenuResult->fetch_assoc()) {
                array_push($this->specificDateBazarDataList,$row);
                array_push($row_array,$row);

            }
            echo json_encode($row_array);

        } else {

            echo json_encode(0);
        }
    }
    /*public function getSpecificBazarDateData($specifiedDate){
        $this->setSpecificBazarDateData($specifiedDate);
        foreach ($this->specificDateBazarDataList as $value){
            echo $value;
        }
    }*/
    private function specifiedUserName($userId){
        $conn=$this->oodbconfig->get_connection();
        $query="select firstName,lastName from userinfo where id='$userId'";
        $res=$conn->query($query);
        while ($row=$res->fetch_assoc()){
            return ucwords($row['firstName']." ".$row['lastName']);
        }
    }

    //Both Query Work
    private function setNextShopperName()
    {
        $conn=$this->oodbconfig->get_connection();
        $sql="SELECT selected_person_id as 'sel_id'
              FROM shoppingpersonselection 
              WHERE selected_date > CURDATE() AND group_id='".$this->groupId."'
              ORDER BY selected_date ASC  
              LIMIT 1";
        //$sql="SELECT selected_person_id as 'sel_id' FROM shoppingpersonselection WHERE selected_date > NOW() ORDER BY ABS(DATEDIFF(selected_date, NOW())) ASC LIMIT 3";
        $result=$conn->query($sql);
        if ($conn->affected_rows>0){
            $row=$result->fetch_assoc();
            $this->nextShopperName =$this->specifiedUserName($row['sel_id']);
            //return $this->nextShopperName;
        }
        else{
            $this->nextShopperName='None !';
        }
    }

    public function getNextShopperName()
    {
        return $this->nextShopperName;
    }

    public function getBazarListStatus()
    {
        return $this->bazar_list_status;
    }

    public function getShopperId()
    {
        return $this->shopper_id;
    }

    public function getShopperName()
    {
        return $this->shopper_name;
    }

    /**
     * @return mixed
     */
    public function getTodayBazarList()
    {
        return $this->todayBazarList;
    }


    public function getTodayTotalBazarCost()
    {
        return $this->todayTotalBazarCost;
    }


    public function getCurrentMonthBazarDetails()
    {
        return $this->currentMonthBazarDetails;
    }
    /**
     * @return mixed
     */
    public function getCurrentMonthTotalBazarCost()
    {
        return $this->currentMonthTotalBazarCost;
    }
    private function formatDate($date)
    {
        $changed_date = DateTime::createFromFormat('Y-m-d', $date);
        $newFormattedDate = $changed_date->format("d/m/Y");
        return $newFormattedDate;
    }

}
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $dailyCostApprovalFetch = new managerShoppingCostFetch();
    if (isset($_POST['specificDate'])){

        $dailyCostApprovalFetch->specificBazarDateData($_POST['specificDate']);
    }
    if (isset($_POST['showSpecificDateBazarDetails'])){
        $changed_date = DateTime::createFromFormat('Y-m-d', $_POST['showSpecificDateBazarDetails']);
        $specifiedDate = $changed_date->format("d/m/Y");
        $dailyCostApprovalFetch->specificBazarDateData($specifiedDate);
    }
}
?>