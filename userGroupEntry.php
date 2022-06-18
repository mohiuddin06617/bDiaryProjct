<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 1/11/2018
 * Time: 4:47 AM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";
class userGroupEntry extends oodbconfig{
    private $userId;
    private $groupId;
    private $oodbconfig;
    private $currentTotalMember;

    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->userId=$_SESSION['userID'];
        $this->groupId=$_SESSION['groupID'];
        $this->setCurrentTotalMember();
    }

    public function removeUser(){
        $conn=$this->oodbconfig->get_connection();
        $sql="Update userinfo set userGroupStatus=0,group_id=0 where userinfo.id='".$this->userId."'";
        $result=$conn->query($sql);
        if ($conn->affected_rows==1){
            $currentMember=$this->getCurrentTotalMember();
            $currentMember=$currentMember-1;
            if ($this->UpdateTotalMember($currentMember)){
                unset($_SESSION['groupID']);
                echo "You are no longer member of the group";
            }
            else{
                echo "Some Error".$conn->error_list;
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
        $conn=$this->oodbconfig->get_connection();
        $query="select total_member from groupDetails where group_id='".$this->groupId."'";
        $result=$conn->query($query);
        $row=$result->fetch_assoc();
        $this->currentTotalMember=$row['total_member'];
    }
    private function UpdateTotalMember($currentMember){
        $conn=$this->oodbconfig->get_connection();
        $sql="Update groupDetails set total_member='$currentMember' WHERE group_id='$this->groupId'";
        $result=$conn->query($sql);
        if ($result){
            return true;
        }else {
            return false;
        }
    }

}
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $groupDetailsUserEntry=new userGroupEntry();
    if (isset($_POST['leave'])){
        $groupDetailsUserEntry->removeUser();
    }
}

?>