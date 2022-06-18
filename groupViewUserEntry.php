<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 1/12/2018
 * Time: 11:24 AM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class groupViewUserEntry extends oodbconfig
{
    private $userId;
    private $email;
    private $oodbconfig;
    private $selected_group_id;
    private $currentTotalMember;

    function __construct()
    {
        $this->userId = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
        $this->email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
        $this->selected_group_id = isset($_SESSION['newUserSelectedGroupId']) ? $_SESSION['newUserSelectedGroupId'] : null;
        $this->oodbconfig = new oodbconfig();
        $this->setCurrentTotalMember();
    }


    public function addUser()
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "Update userinfo set userGroupStatus=1,group_id='$this->selected_group_id' where userinfo.id='" . $this->userId . "'";
        $result = $conn->query($sql);
        if ($conn->affected_rows == 1) {
            $currentMember = $this->getCurrentTotalMember();
            $currentMember = $currentMember + 1;
            if ($this->UpdateTotalMember($currentMember)) {
                if (isset($_SESSION['newUserSelectedGroupId'])) {
                    unset($_SESSION['newUserSelectedGroupId']);
                }
                echo "Welcome! Now you are a member of this group";
            } else {
                echo "Some Error";
            }

        }

    }

    /**
     * @return mixed
     */
    public function getCurrentTotalMember()
    {
        return $this->currentTotalMember;
    }

    /**
     * @param mixed $currentTotalMember
     */
    private function setCurrentTotalMember()
    {
        $conn = $this->oodbconfig->get_connection();
        $query = "select total_member from groupDetails where group_id='" . $this->selected_group_id . "'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $this->currentTotalMember = $row['total_member'];
    }

    private function UpdateTotalMember($currentMember)
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "Update groupDetails set total_member='$currentMember' WHERE group_id='$this->selected_group_id'";
        $result = $conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['groupJoinData'])) {
        $groupViewUserEntry = new groupViewUserEntry();
        if (isset($_SESSION['newUserSelectedGroupId'])){
            $groupViewUserEntry->addUser();
        }
    }
}
?>