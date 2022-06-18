<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 1/12/2018
 * Time: 11:54 AM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class groupViewUserFetch extends oodbconfig
{
    private $userId;
    private $email;
    private $oodbconfig;
    private $selected_group_id;
    private $groupName;
    private $managerId;
    private $managerName;
    private $managerEmail;
    private $groupDescription;
    private $totalMember;
    private $houseAddress;
    private $maidName;
    private $maidPhone;
    private $maidAddress;
    private $managerPhoneNumber;
    private $memberList = array();


    function __construct()
    {
        $this->userId = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
        $this->email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
        $this->oodbconfig = new oodbconfig();
    }

    public function checkQueryExistence($query)
    {
        $conn = $this->oodbconfig->get_connection();
        $status = false;
        /*$sql="SELECT * FROM groupDetails WHERE MATCH(group_name) AGAINST('$query' IN NATURAL LANGUAGE MODE)";*/
        $sql = "select group_id from groupDetails where group_name LIKE '" . $query . "'";
        $result = $conn->query($sql);
        $res = $result->fetch_assoc();
        $this->selected_group_id = $res['group_id'];
        if ($conn->affected_rows > 0) {
            $status = true;
        }
        return $status;
    }

    public function executeAllFunction()
    {
        $this->setGroupDetails();
        $this->setGroupMemberList();
        $this->setManagerDetails();
    }

    private function setGroupDetails()
    {
        $conn = $this->oodbconfig->get_connection();
        $groupQuery = "select group_name,manager_id,total_member,group_description,house_address,maid_name,maid_phone,maid_address from groupDetails,groupOtherDetails where groupDetails.group_id='$this->selected_group_id' AND groupDetails.group_id=groupOtherDetails.group_id";
        $groupQueryResult = $conn->query($groupQuery);
        if ($groupQueryResult->num_rows > 0) {
            $row = $groupQueryResult->fetch_assoc();
            $this->managerId = $row['manager_id'];
            $this->groupName = $row['group_name'];
            $this->totalMember = $row['total_member'];
            $this->groupDescription = $row['group_description'];
            $this->houseAddress = $row['house_address'];
            $this->maidName = $row['maid_name'];
            $this->maidPhone = $row['maid_phone'];
            $this->maidAddress = $row['maid_address'];
        }

    }

    private function setGroupMemberList()
    {
        $conn = $this->oodbconfig->get_connection();
        $groupMemberListQuery = "select firstName,lastName,email,phoneNumber from userinfo WHERE group_id='$this->selected_group_id' and userStatus=0";
        $groupMemberList = $conn->query($groupMemberListQuery);
        if ($groupMemberList->num_rows > 0) {
            while ($row = $groupMemberList->fetch_assoc()) {
                array_push($this->memberList, $row);
            }
        }
    }

    private function setManagerDetails()
    {
        $conn = $this->oodbconfig->get_connection();
        $query = "select firstName,lastName,email,phoneNumber from userinfo WHERE group_id='$this->selected_group_id' and userStatus=1";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->managerName = ucwords($row['firstName'] . " " . $row['lastName']);
            $this->managerEmail = $row['email'];
            $this->managerPhoneNumber = $row['phoneNumber'];
        }
    }

    /**
     * @return array
     */
    public function getMemberList()
    {
        return $this->memberList;
    }


    public function getGroupName()
    {
        return $this->groupName;
    }


    public function getManagerId()
    {
        return $this->managerId;
    }


    public function getManagerName()
    {
        return $this->managerName;
    }


    public function getTotalMember()
    {
        return $this->totalMember;
    }


    public function getManagerEmail()
    {
        return $this->managerEmail;
    }


    public function getGroupDescription()
    {
        return $this->groupDescription;
    }


    public function getHouseAddress()
    {
        return $this->houseAddress;
    }


    public function getMaidName()
    {
        return $this->maidName;
    }


    public function getMaidPhone()
    {
        return $this->maidPhone;
    }


    public function getMaidAddress()
    {
        return $this->maidAddress;
    }


    private function getManagerPhoneNumber()
    {
        return $this->managerPhoneNumber;
    }

    public function getSelectedGroupId()
    {
        return $this->selected_group_id;
    }
}

?>