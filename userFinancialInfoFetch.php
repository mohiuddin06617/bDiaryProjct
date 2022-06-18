<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 1/16/2018
 * Time: 8:20 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class userFinancialInfoFetch extends oodbconfig
{
    private $oodbconfig;
    private $userId;
    private $groupId;
    private $monthGroupTotalCost;
    private $currentMonth;
    private $currentYear;
    private $totalGroupMember;
    private $totalNumberOfMeal;
    private $totalMealCost;
    private $currentMonthMealCost;
    private $totalBazarCost;
    private $groupName;
    private $perMemberMealCost = array();
    private $groupFinancialDataInfo; //This variable contains information like House Rent,Electricity Bill etc.
    private $allMemberList = array();
    private $allBillWithoutMeal = array();
    private $groupMemberList=array();


    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->userId=$_SESSION['userID'];
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
        if ($conn->affected_rows > 0) {
            $row = $totalMember->fetch_assoc();
            $this->totalGroupMember = $row['total_member'];
            $this->groupName = $row['group_name'];
        } else {
            $this->totalGroupMember = 1;
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
        $groupBillListQuery = "select groupFinancialId,billName,billAmount,currency,enteredMonth,enteredYear from groupfinancialdata WHERE groupId='$this->groupId' and enteredMonth='$this->currentMonth' AND enteredYear='$this->currentYear'";
        $groupBillListResult = $conn->query($groupBillListQuery);
        if ($groupBillListResult->num_rows > 0) {
            $tile='';
            while ($row = mysqli_fetch_assoc($groupBillListResult)) {
                //array_push($this->groupBilList, $row);
                $tile .= "<tr>
                             <td>".$row['billName']."</td>
                             <td>".$row['billAmount']." ".$row['currency']."</td>
                             <td>".round($row['billAmount']/$this->getTotalGroupMember(),2)." ".$row['currency']."</td>
                         </tr>";
            }
            return $tile;

        }
        else{
            return "0 Data ".$conn->error;
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
        $query = "SELECT SUM(item_price) 
                            AS 'total_bazar_cost'
                            FROM `userdailycost`
                            WHERE group_id='$this->groupId' AND Month(entry_time_date)= Month(CURRENT_DATE) 
                            AND YEAR(entry_time_date)=YEAR(CURDATE()) GROUP BY Month(entry_time_date)";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->totalBazarCost = round($row['total_bazar_cost'], 2);
            }
        } else {
            $this->totalBazarCost = 1;
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

    public function getUserId()
    {
        return $this->userId;
    }

}


?>