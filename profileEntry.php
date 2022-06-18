<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 12/27/2017
 * Time: 12:47 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class profileEntry extends oodbconfig
{
    private $managerId;
    private $groupId;
    private $oodbconfig;
    private $selectedId;
    private $totalMember;

    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->groupId = $_SESSION['groupID'];
        $this->managerId = $_SESSION['managerID'];
        $this->setTotalMember();


    }


    public function getSelectedId()
    {
        return $this->selectedId;
    }

    public function setSelectedId($id)
    {
        $this->selectedId = $id;
    }

    public function updateUserInfo()
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "UPDATE userinfo SET userGroupStatus=1,group_id='" . $this->groupId . "' WHERE id='" . $this->selectedId . "'";
        $result = $conn->query($sql);
        if ($result) {
            echo "He is now memebr of Your group";
        } elseif (!$result) {
            echo "Can not complete the opreation" . $conn->error;
        }
    }

    private function setTotalMember()
    {
        $conn = $this->oodbconfig->get_connection();
        $sql="SELECT total_member FROM groupdetails WHERE groupdetails.group_id='$this->groupId'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $this->totalMember = $row['total_member'];
        }
        /*if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->totalMember = $row['total_member'];
            }
        } else {
            $this->totalMember = 0;
        }*/
    }

    public function increaseTotalMember(){
        $conn=$this->oodbconfig->get_connection();
        $this->totalMember=$this->totalMember+1;
        $query="Update groupDetails SET  total_member='".$this->totalMember."' where group_id='".$this->groupId."'";
        $result=$conn->query($query);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['userId'])) {
        $profileEntry = new profileEntry();
        $profileEntry->setSelectedId($_POST['userId']);
        $profileEntry->updateUserInfo();
        $profileEntry->increaseTotalMember();
    }
}
?>