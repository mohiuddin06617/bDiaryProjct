<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 12/27/2017
 * Time: 2:22 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class groupDetailsManagerEntry extends oodbconfig
{

    private $oodbconfig;
    private $totalMember;
    private $groupId;
    private $managerId;

    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->groupId = isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->managerId = isset($_SESSION['managerID'])?$_SESSION['managerID']:null;
        $this->setTotalMember();

    }

    public function removeUser($userId)
    {
        $stat=false;
        $conn = $this->oodbconfig->get_connection();
        $sql = "UPDATE userinfo SET userGroupStatus=0,group_id=0 WHERE id='" . $userId . "'";
        $result = $conn->query($sql);
        if ($result) {
           $stat=true;
        }
        return $stat;
    }

    public function reduceOneMember()
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $this->totalMember = $this->totalMember - 1;
        $query = "Update groupDetails SET total_member='" . $this->totalMember . "' where group_id='" . $this->groupId . "'";
        $result = $conn->query($query);
        if ($result) {
            $stat = true;
        }
        return $stat;

    }

    public function getTotalMember()
    {
        return $this->totalMember;
    }

    /**
     * @param mixed $totalMember
     */
    private function setTotalMember()
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "SELECT total_member FROM groupdetails WHERE groupdetails.group_id='$this->groupId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->totalMember = $row['total_member'];
            }
        } else {
            $this->totalMember = 0;
        }
    }

    public function updateGroupDetails($groupName, $groupDesc, $houseAddress, $maidName, $maidPhone, $maidAdress)
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = $conn->prepare("Update groupDetails,groupOtherDetails SET groupDetails.group_name=?,groupOtherDetails.group_description=?,
                groupOtherDetails.house_address=?,groupOtherDetails.maid_name=?,
                groupOtherDetails.maid_phone=?,groupOtherDetails.maid_address=? WHERE groupDetails.group_id=? AND groupDetails.group_id=groupOtherDetails.group_id");
        $sql->bind_param('ssssisi',$groupName,$groupDesc,$houseAddress,$maidName,$maidPhone,$maidAdress,$this->groupId);
        if ($sql->execute()) {
            echo $sql->affected_rows . " Data Successfully Updated";
        } else {
            trigger_error($sql->error, E_USER_ERROR);
        }
        /*if ($conn->affected_rows > 0) {
            echo $conn->affected_rows . " Rows Affected";
        } else {
            echo "0 Rows Updated and Reason" . $conn->error;
        }*/
    }

    public function changeManagerId($newManagerId){
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $query ="Update groupDetails SET groupDetails.manager_id=$newManagerId WHERE groupDetails.group_id='$this->groupId'";
        $result = $conn->query($query);
        if ($result) {
            $stat = true;
        }
        return $stat;

    }
    public function changePrevManagerUserStatus($oldManagerId){
        $stat = false;
        $userStatus=0;
        $conn = $this->oodbconfig->get_connection();
        $query ="Update userinfo SET userinfo.userStatus=0 WHERE userinfo.id='".$oldManagerId."'"; /*$conn->prepare("Update userinfo SET userinfo.userStatus=? WHERE userinfo.id=?");*/
        /*$query->bind_param('ii',$userStatus,$oldManagerId);*/
        $result = $conn->query($query);
        if ($result) {
            $stat = true;
        }
        return $stat;

    }
    public function changeNewManagerUserStatus($newManagerId){
        $stat = false;
        $userStatus=1;
        $conn = $this->oodbconfig->get_connection();
        $query = "Update userinfo SET userinfo.userStatus=1 WHERE userinfo.id='".$newManagerId."'";
        //$query->bind_param('ii',$userStatus,$newManagerId);
        if ($conn->query($query)) {
            $stat = true;
            $_SESSION['managerID']=$newManagerId;
        }
        return $stat;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $groupDetailsManagerEntry = new groupDetailsManagerEntry();
    if (isset($_POST['action'])) {
        if (($_POST['action'] === "removeUser") && isset($_POST['userId'])) {
            //echo $_POST['action']." ".$_POST['userId']." : ".$groupDetailsManagerEntry->getTotalMember();
            if ((int)$_POST['userId']===$_SESSION['managerID']){

                echo "Please Make Someone Else Manager First";

            }
            else{
                //echo $_POST['action']." ".$_POST['userId']." : ".$groupDetailsManagerEntry->getTotalMember()." M Id".$_SESSION['managerID'];
                if ($groupDetailsManagerEntry->getTotalMember() > 1) {
                    if ($groupDetailsManagerEntry->removeUser($_POST['userId'])) {
                        if ($groupDetailsManagerEntry->reduceOneMember()) {
                            echo http_response_code("200");
                        }
                    }
                } else {
                    echo "You can not remove yourself! Then Group will be destroyed";
                }
            }

        }
        if (($_POST['action'] == "changeManager") && isset($_POST['selectedPersonId'])) {
            $newManagerId = (int)$_POST['selectedPersonId'];
            $oldManagerId = isset($_SESSION['managerID'])?$_SESSION['managerID']:null;

            if ($groupDetailsManagerEntry->changePrevManagerUserStatus($oldManagerId)) {
                if ($groupDetailsManagerEntry->changeNewManagerUserStatus($newManagerId)) {
                    if ($groupDetailsManagerEntry->changeManagerId($newManagerId)) {
                        echo http_response_code(200);
                    }
                }
            }
        }
    }



    if (isset($_POST['csrfToken'])) {

        $groupName = $_POST['groupName'];
        $groupDescription = $_POST['groupDescription'];
        $groupHouseAddress = $_POST['groupHouseAddress'];
        $groupMaidName = $_POST['groupMaidName'];
        $groupMaidPhone = $_POST['groupMaidPhone'];
        $groupMaidAddress = $_POST['groupMaidAddress'];
        $groupDetailsManagerEntry->updateGroupDetails($groupName, $groupDescription, $groupHouseAddress, $groupMaidName, $groupMaidPhone, $groupMaidAddress);
    }
}

?>