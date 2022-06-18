<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 11/9/2017
 * Time: 10:18 AM
 */

include_once "DbFile/oodbconfig.php";
class dynamically_add_group_member extends oodbconfig{
    private $group_members;
    private $selected_group_name;
    function __construct()
    {
        $this->group_members=array();
    }
    function setGroupName($selected_group_name){
        $this->selected_group_name=$selected_group_name;
    }

    /**
     * @return mixed
     */
    public function getSelectedGroupName()
    {
        return $this->selected_group_name;
    }

    /**
     * @return array
     */
    public function getGroupMembers()
    {
        return $this->group_members;
    }
    function nameAvaiablityCheck(){
        $conn=$this->get_connection();
        $selected_group_name=$this->getSelectedGroupName();
        $sql="select group_name from groupdetails WHERE groupDetails.group_name'$selected_group_name'";
        $result=$conn->query($sql);
        if ($result){
            if ($result->num_rows>0){

            }
            else{
                echo "Name is available";
            }
        }
    }
    function createGroupMember(){

    }
}
?>