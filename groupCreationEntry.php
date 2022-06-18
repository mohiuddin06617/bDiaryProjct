<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 1/31/2018
 * Time: 9:32 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";
class groupCreationEntry extends oodbconfig{

    private $oodbconfig;
    private $userId;
    private $lastInsertedId;
    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->userId=isset($_SESSION['userID'])?$_SESSION['userID']:null;
    }
    public function groupNameExistence($selected_name){
        $stat=false;
        $conn=$this->oodbconfig->get_connection();
        $sql="select * from groupDeatails WHERE group_name='$selected_name'";
        $result=$conn->query($sql);
        if ($conn->affected_rows>0){
            $stat=true;
        }
        return $stat;
    }
    public function groupCreation($group_name){
        $stat=false;
        $conn=$this->oodbconfig->get_connection();
        $member_no=1;
        $query  = $conn->prepare("insert into groupDetails (group_name,manager_id,total_member) values (?,?,?)");
        $query->bind_param('sii',$group_name,$this->userId,$member_no);
        $result=$query->execute();
        if ($result) {
            $this->lastInsertedId=$conn->insert_id;
            $stat=true;
        }
        return $stat;
    }
    public function updateUserInfo(){
        $stat=false;
        $conn=$this->oodbconfig->get_connection();
        $group_status=1;
        $query  = $conn->prepare("Update userinfo set userinfo.group_id=?,userinfo.userGroupStatus=?,userinfo.userStatus=? WHERE userinfo.id=?");
        $query->bind_param('iiii',$this->lastInsertedId,$group_status,$group_status,$this->userId);
        $result=$query->execute();
        if ($result) {
            $stat=true;
        }
        return $stat;
    }
}
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $groupCreationEntry=new groupCreationEntry();
    if (isset($_POST['groupCreationNameEntry']) && !empty($_POST['groupCreationNameEntry'])){
        $group_name=strtoupper($_POST['groupCreationNameEntry']);
        if ($groupCreationEntry->groupNameExistence($group_name)){
            if ($groupCreationEntry->groupCreation($group_name)){
               if ($groupCreationEntry->updateUserInfo()){
                   echo http_response_code(200);
               }
               else{
                   echo "Error in Updating User Information : ".$conn->error;
               }
            }
            else{
                echo "Error in Group Name Insert : ".$conn->error;
            }
        }
        else{
            echo "Name Already Exist";
        }
    }
    else{
        echo "Group Name Not be emoty";
    }
}