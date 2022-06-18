<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 12/8/2017
 * Time: 1:28 PM
 */
/*debug_backtrace() || die("<h1 class='text-center alert alert-warning'>You are permitted to access this file</h1>");*/
include_once "accessRestriction.php";
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class userGroupFetch extends oodbconfig
{
    private $oodbconfig;
    private $memberList = array();
    private $userId;
    private $groupId;
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

    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->userId=isset($_SESSION['userID'])?$_SESSION['userID']:null;
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->setGroupDetails();
        $this->setGroupMemberList();
        $this->setManagerDetails();
    }

    public function setGroupId($gId){
        $this->groupId=$gId;
    }

    private function setGroupDetails()
    {
        $conn = $this->oodbconfig->get_connection();
        $groupQuery = "select group_name,manager_id,total_member,group_description,house_address,maid_name,maid_phone,maid_address from groupDetails,groupOtherDetails where groupDetails.group_id='$this->groupId' AND groupDetails.group_id=groupOtherDetails.group_id";
        $groupQueryResult = $conn->query($groupQuery);
        if ($groupQueryResult->num_rows > 0) {
            $row = $groupQueryResult->fetch_assoc();
            $this->managerId = $row['manager_id'];
            $this->groupName = $row['group_name'];
            $this->totalMember = $row['total_member'];
            $this->groupDescription=$row['group_description'];
            $this->houseAddress=$row['house_address'];
            $this->maidName=$row['maid_name'];
            $this->maidPhone=$row['maid_phone'];
            $this->maidAddress=$row['maid_address'];
        }

    }

    private function setGroupMemberList()
    {
        $conn = $this->oodbconfig->get_connection();
        $groupMemberListQuery = "select firstName,lastName,email,phoneNumber from userinfo WHERE group_id='$this->groupId' and userStatus=0";
        $groupMemberList = $conn->query($groupMemberListQuery);
        if ($groupMemberList->num_rows > 0) {
            while ($row = $groupMemberList->fetch_assoc()) {
                    array_push($this->memberList,$row);
            }
        }
    }

    private function setManagerDetails(){
        $conn = $this->oodbconfig->get_connection();
        $query = "select firstName,lastName,email,phoneNumber from userinfo WHERE group_id='$this->groupId' and userStatus=1";
        $result=$conn->query($query);
        if ($result->num_rows>0){
            $row=$result->fetch_assoc();
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

    /**
     * @return mixed
     */
    public function getManagerName()
    {
        return $this->managerName;
    }

    /**
     * @return mixed
     */
    public function getTotalMember()
    {
        return $this->totalMember;
    }

    /**
     * @return mixed
     */
    public function getManagerEmail()
    {
        return $this->managerEmail;
    }

    /**
     * @return mixed
     */
    public function getGroupDescription()
    {
        return $this->groupDescription;
    }

    /**
     * @return mixed
     */
    public function getHouseAddress()
    {
        return $this->houseAddress;
    }

    /**
     * @return mixed
     */
    public function getMaidName()
    {
        return $this->maidName;
    }

    /**
     * @return mixed
     */
    public function getMaidPhone()
    {
        return $this->maidPhone;
    }

    /**
     * @return mixed
     */
    public function getMaidAddress()
    {
        return $this->maidAddress;
    }
    
    /**
     * @return mixed
     */
    public function getManagerPhoneNumber()
    {
        return $this->managerPhoneNumber;
    }

}
/*for ($i=0;$i<$gdf->getTotalMember();$i++){
    foreach ($gdf->getMemberList()[$i] as $item) {
        echo $item." ";
    }
}*/
/*$gdf=new userGroupFetch();
print_r($gdf->getMemberList());*/
?>

