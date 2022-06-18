<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 1/16/2018
 * Time: 8:20 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class groupFinancialInfoFetch extends oodbconfig
{
    private $oodbconfig;
    private $managerId;
    private $groupId;
    private $monthGroupTotalCost;
    private $currentMonth;
    private $currentYear;
    private $totalGroupMember;
    private $totalNumberOfMeal;
    private $totalMealCost;
    private $currentMonthMealCost;
    private $totalBazarCost;
    private $perMemberBill = array();
    private $necessaryVal;
    private $groupName;
    private $groupBilList = array();
    private $perMemberMealCost = array();
    private $groupFinancialDataInfo; //This variable contains information like House Rent,Electricity Bill etc.
    private $allMemberList = array();
    private $allBillWithoutMeal = array();
    private $groupMemberList=array();


    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->managerId = isset($_SESSION['managerID'])?$_SESSION['managerID']:null;
        $this->groupId = isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->currentMonth = date('m');
        $this->currentYear = date('Y');
        $this->setTotalGroupMember();
        $this->setTotalNumberOfMeal();
        $this->setAllMemberList();
        $this->setGroupFinancialDataInfo();
        $this->groupTotalBazarCost();
        $this->setCurrentMonthMealCost();
        $this->setAllBillWithoutMeal();

    }

    private function setTotalGroupMember()
    {
        $conn = $this->oodbconfig->get_connection();
        $totalMemberQuery = "select group_name,total_member from groupDetails where group_id='" . $this->groupId . "'";
        $totalMember = $conn->query($totalMemberQuery);
        if ($totalMember->num_rows > 0) {
            $row = $totalMember->fetch_assoc();
            $this->totalGroupMember = $row['total_member'];
            $this->groupName = $row['group_name'];
        } else {
            $this->totalGroupMember = 0;
        }

    }

    private function setGroupFinancialDataInfo()
    {
        $conn = $this->oodbconfig->get_connection();
        $totalAmoutQuery = "select SUM(billAmount) as total_amount from groupFinancialData 
        WHERE groupId='$this->groupId' and enteredMonth='$this->currentMonth' AND enteredYear='$this->currentYear'";
        $totalAmount = $conn->query($totalAmoutQuery);
        if ($totalAmount->num_rows > 0) {
            while ($row = $totalAmount->fetch_assoc()) {
                $this->groupFinancialDataInfo = round($row['total_amount'] / $this->getTotalGroupMember(), 2);
            }
        } else {
            $this->groupFinancialDataInfo = 1;
        }
    }

    private function setTotalNumberOfMeal()
    {
        $conn = $this->oodbconfig->get_connection();
        $totalNoOfMealQuery = "select SUM(noOfMeal) as 'total_no_meal' from mealstatus WHERE 
          userGroupId='$this->groupId' AND Month(mealentrytime)= Month(CURRENT_DATE) AND YEAR(mealentrytime)=YEAR(CURDATE())";
        $totalNoOfMeal = $conn->query($totalNoOfMealQuery);
        if ($conn->affected_rows > 0) {
            while ($row = $totalNoOfMeal->fetch_assoc()) {
                $this->totalNumberOfMeal = $row['total_no_meal'];
            }
        } else {
            $this->totalNumberOfMeal = 1;
        }
    }

    private function setAllMemberList()
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "select id,CONCAT(firstName,' ', lastName) as 'fullName' from userinfo WHERE 
          group_id='$this->groupId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $fullName = $row['fullName'];
                $row['fullName'] = ucwords($row['fullName']);
                array_push($this->allMemberList, $row);
            }
        }
    }

    public function groupBillList()
    {
        $conn = $this->oodbconfig->get_connection();
        $groupBillListQuery = "select groupFinancialId,billName,billAmount,currency,enteredMonth,enteredYear from groupfinancialdata 
                                WHERE groupId='$this->groupId' and enteredMonth='$this->currentMonth' AND enteredYear='$this->currentYear'";
        $groupBillListResult = $conn->query($groupBillListQuery);
        if ($groupBillListResult->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($groupBillListResult)) {
                //array_push($this->groupBilList, $row);
                $billName=$row['billName'];
                $billAmount=$row['billAmount'];
                $financialId=$row['groupFinancialId'];
                $tile = "<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-6\">
                          <div class=\"info-tile info-tile-alt tile-primary partialAmount\"
                          data-toggle=\"tooltip\" title=\"22.4% more than previous month\" id='$financialId'>
                          <div class=\"tile-icon editSpan\"><i class=\"fa fa-home\"></i></div>
                          <div class=\"tile-heading white-text-color\"><span class='editSpan billName'>";

                $tile .= $billName;
                $tile .= "</span><input class='editInput billName form-control input-sm' type='text' name='bNInlineInput' value='$billName' style='display: none;'/></div>";
                $tile .= "<div class=\"tile-body\">";
                $tile .= "<span class='editSpan billAmount'>".$billAmount."</span>
                            <input class='editInput billAmount form-control input-sm' type='text' name='bAInlineInput' value='$billAmount' style='display: none;'/>";
                $tile .= "  <a type=\"button\" class=\"btn btn-default btn-link btn-sm editBtn\">
                                     <i class=\"fa fa-edit\"></i> Edit</a>
                            <a type=\"button\" class=\"btn btn-link btn-danger btn-sm white-text-color deleteBtn\">
                                     <i class=\"fa fa-trash\"></i> Delete</a>
                            <a type=\"button\" class=\"btn btn-default btn-link btn-sm updateBtn\" style='display: none;'>
                                     <i class=\"fa fa-refresh\"></i> Update</a>
                            <a type=\"button\" class=\"btn btn-link btn-danger btn-sm white-text-color cancelBtn\" style='display: none;'>
                                     <i class=\"fa fa-stop\"></i> Cancel</a>
                          </div>
                          <div class=\"tile-footer\">
                          <span style=\"color: white !important; font-weight: bolder\">Currency :".$row['currency']."</span></div>
                          </div>
                          </div>";
                echo $tile;
            }

        }
    }

    public function perUserMealCost($userId)
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "select SUM(noOfMeal) as 'individual_total_meal' from mealStatus WHERE userGroupId='$this->groupId' 
              AND user_id='$userId' AND Month(mealentrytime)= Month(CURRENT_DATE) 
              AND YEAR(mealentrytime)=YEAR(CURDATE()) GROUP BY Month(mealentrytime)";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $individualTotalMeal = $row['individual_total_meal'];
                return round($this->getCurrentMonthMealCost() * $individualTotalMeal);
            }
        } else {
            return 1;
        }

    }
    public function perUserBalance($userId)
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "SELECT group_id,SUM(item_price) 
                            AS 'total_bazar_cost',item_price,entry_time_date
                            FROM `userdailycost`
                            WHERE group_id='$this->groupId' AND user_id='$userId' AND Month(entry_time_date)= Month(CURRENT_DATE) 
                            AND YEAR(entry_time_date)=YEAR(CURDATE()) GROUP BY Month(entry_time_date)";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $individualTotalBazarCost = $row['total_bazar_cost'];
                return $individualTotalBazarCost;
            }
        } else {
            return 1;
        }

    }

    private function setAllBillWithoutMeal()
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "SELECT billName,billAmount from groupFinancialData WHERE groupId='$this->groupId' 
                    AND enteredMonth= '" . $this->currentMonth . "' 
                    AND enteredYear= '" . $this->currentYear . "'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['billAmount'] = round($row['billAmount'] / $this->getTotalGroupMember(), 2);
                array_push($this->allBillWithoutMeal, $row);
            }
        }
    }

    private function setCurrentMonthMealCost()
    {
        $this->currentMonthMealCost = round($this->getTotalBazarCost() / $this->getTotalNumberOfMeal(), 2);
    }

    private function groupTotalBazarCost()
    {
        $conn = $this->oodbconfig->get_connection();
        $query = "SELECT group_id,SUM(item_price) 
                            AS 'total_bazar_cost',item_price,entry_time_date
                            FROM `userdailycost`
                            WHERE group_id='$this->groupId' AND Month(entry_time_date)= Month(CURRENT_DATE) 
                            AND YEAR(entry_time_date)=YEAR(CURDATE()) GROUP BY Month(entry_time_date)";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->totalBazarCost = round($row['total_bazar_cost'], 2);
            }
        } else {
            $this->totalBazarCost = 0;
        }
    }

    /**
     * @param mixed $monthGroupTotalCost
     */
    public function setMonthGroupTotalCost($monthGroupTotalCost)
    {
        $this->monthGroupTotalCost = $this->monthGroupTotalCost + $monthGroupTotalCost;
    }

    /**
     * @param mixed $totalMealCost
     */
    public function setTotalMealCost($totalMealCost)
    {
        $this->totalMealCost =$this->totalMealCost+ $totalMealCost;
    }

    public function getMonthGroupTotalCost()
    {
        return $this->monthGroupTotalCost;
    }

    public function getAllMemberList()
    {
        return $this->allMemberList;
    }


    public function getAllBillWithoutMeal()
    {
        return $this->allBillWithoutMeal;
    }

    public function getCurrentMonthMealCost()
    {
        return $this->currentMonthMealCost;
    }


    public function getTotalMealCost()
    {
        return $this->totalMealCost;
    }


    public function getTotalBazarCost()
    {
        return $this->totalBazarCost;
    }


    public function getGroupFinancialDataInfo()
    {
        return $this->groupFinancialDataInfo;
    }

    public function getTotalNumberOfMeal()
    {
        if ($this->totalNumberOfMeal == 0) {
            return 1;
        }
        return $this->totalNumberOfMeal;
    }

    public function getTotalGroupMember()
    {
        return $this->totalGroupMember;
    }


    public function getGroupName()
    {
        return $this->groupName;
    }

}

/*$g = new userFinancialInfoFetch();
echo "Bill Like House Rent,Water Bill etc. : " . $g->getGroupFinancialDataInfo() . "<br>";
echo "Group Bazar Cost : " . $g->getTotalBazarCost() . "<br>";
echo "Total No Of Meal : " . $g->getTotalNumberOfMeal() . "<br>";
echo $g->getCurrentMonthMealCost() . "<br>";

echo "Group member ID : ";
print_r($g->getAllMemberList());
echo "<br>";
for ($i = 0; $i < count($g->getAllMemberList()); $i++) {
    $id=$g->getAllMemberList()[$i]['id'];
    $fullName=$g->getAllMemberList()[$i]['fullName'];
    echo $fullName." : ". ($g->perUserMealCost($id)+$g->getGroupFinancialDataInfo())."<br>";

}*/
/*foreach ($g->getAllMemberList() as $val) {
    foreach ($val as $value) {
        echo "For ID " . $value . " Cost : " . ($g->perUserMealCost($value) + $g->getGroupFinancialDataInfo()) . "<br>";
    }
}*/
/*$g = new userFinancialInfoFetch();

for ($i = 0; $i < count($g->getAllMemberList()); $i++) {
    $id=$g->getAllMemberList()[$i]['id'];
    echo $g->perUserMealCost($id)."<br>";

}
print_r($g->getAllBillWithoutMeal());
echo "<br>";
for ($i = 0; $i < count($g->getAllBillWithoutMeal()); $i++) {
    echo "<b>".$g->getAllBillWithoutMeal()[$i]['billName']." : ".$g->getAllBillWithoutMeal()[$i]['billAmount']."</b>    <br>";
}*/
/*foreach ($g->getAllBillWithoutMeal() AS $v){
    print_r( $v);
}*/
/*$userFinancialInfoFetch=new userFinancialInfoFetch();
for ($i = 0; $i < count($userFinancialInfoFetch->getAllMemberList()); $i++) {
    $id = $userFinancialInfoFetch->getAllMemberList()[$i]['id'];
    $fullName = $userFinancialInfoFetch->getAllMemberList()[$i]['fullName'];
    echo $fullName." ".$id."<br>";
    for ($j = 0; $j < count($userFinancialInfoFetch->getAllBillWithoutMeal()); $j++) {
        $billName = $userFinancialInfoFetch->getAllBillWithoutMeal()[$j]['billName'];
        $billAmount = $userFinancialInfoFetch->getAllBillWithoutMeal()[$j]['billAmount'];
        //echo $billName." ".$billAmount."<br>";
        echo "<tr>
                                                                             <td>" . $billName . "</td>
                                                                             <td>" . $billAmount . "</td>
                                                                          </tr>";
    }
    echo "<br><hr>";
}*/
if ($_SERVER['REQUEST_METHOD']=="POST") {
    if (isset($_POST['memberMonthData'])) {
        $fullNameArray=array();
        $amountArray=array();
        $fullNameAmountArr=array();
        $groupFinancialInfoFetch=new groupFinancialInfoFetch();
        for ($i = 0; $i < count($groupFinancialInfoFetch->getAllMemberList()); $i++) {
            $idForTotalAmount = $groupFinancialInfoFetch->getAllMemberList()[$i]['id'];
            array_push($fullNameArray,$groupFinancialInfoFetch->getAllMemberList()[$i]['fullName']);
            array_push($amountArray,$groupFinancialInfoFetch->perUserMealCost($idForTotalAmount) + $groupFinancialInfoFetch->getGroupFinancialDataInfo());
            /*$fullNameAmount['memberName']= $groupFinancialInfoFetch->getAllMemberList()[$i]['fullName'];
            $fullNameAmount['monthCost']= $groupFinancialInfoFetch->perUserMealCost($idForTotalAmount) + $groupFinancialInfoFetch->getGroupFinancialDataInfo();*/
            $fullNameAmountArr= array_combine($fullNameArray,$amountArray);
        }
        echo json_encode($fullNameAmountArr);
    }
}
?>